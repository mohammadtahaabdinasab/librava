import json
import sys
import urllib.request
import urllib.error
import urllib.parse
from dataclasses import dataclass
from typing import Any, Dict, Optional, Tuple


@dataclass
class Config:
    base_url: str = "http://librava.local"
    token: str = "local_xxxxxxxx"


def http_request(
    cfg: Config,
    method: str,
    path: str,
    data: Optional[Dict[str, Any]] = None,
) -> Tuple[int, str]:
    url = cfg.base_url.rstrip("/") + path

    headers = {
        "Accept": "application/json",
        "Authorization": f"Bearer {cfg.token}",
    }

    body = None
    if data is not None:
        body = json.dumps(data, ensure_ascii=False).encode("utf-8")
        headers["Content-Type"] = "application/json"

    req = urllib.request.Request(url, data=body, headers=headers, method=method)

    try:
        with urllib.request.urlopen(req) as resp:
            return resp.status, resp.read().decode("utf-8", errors="replace")
    except urllib.error.HTTPError as e:
        return e.code, e.read().decode("utf-8", errors="replace")
    except urllib.error.URLError as e:
        return 0, f"Network error: {e}"


def pretty_json(text: str) -> str:
    try:
        obj = json.loads(text)
        return json.dumps(obj, ensure_ascii=False, indent=2)
    except Exception:
        return text


def prompt_int(msg: str, default: Optional[int] = None) -> int:
    while True:
        s = input(msg).strip()
        if s == "" and default is not None:
            return default
        try:
            return int(s)
        except ValueError:
            print("Please enter a valid integer.")


def prompt_str(msg: str, default: Optional[str] = None) -> str:
    s = input(msg).strip()
    if s == "" and default is not None:
        return default
    return s


# ---------------- Books ----------------

def list_books(cfg: Config) -> None:
    page = prompt_int("page (default 1): ", default=1)
    per_page = prompt_int("per_page (default 10, max 50): ", default=10)
    search = prompt_str("search (optional): ", default="")

    qs = f"?page={page}&per_page={per_page}"
    if search:
        qs += f"&search={urllib.parse.quote(search)}"

    status, body = http_request(cfg, "GET", f"/api/books{qs}")
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


def show_book(cfg: Config) -> None:
    book_id = prompt_int("book id: ")
    status, body = http_request(cfg, "GET", f"/api/books/{book_id}")
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


def create_book(cfg: Config) -> None:
    title = prompt_str("title: ")
    author = prompt_str("author: ")
    year_s = input("published_year (optional): ").strip()
    payload: Dict[str, Any] = {"title": title, "author": author}
    if year_s != "":
        try:
            payload["published_year"] = int(year_s)
        except ValueError:
            print("published_year ignored (not a number).")

    status, body = http_request(cfg, "POST", "/api/books", payload)
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


def update_book(cfg: Config) -> None:
    book_id = prompt_int("book id: ")

    print("Leave fields empty to keep existing values.")
    title = input("title (optional): ").strip()
    author = input("author (optional): ").strip()
    year_s = input("published_year (optional): ").strip()
    avail_s = input("available (0/1, optional): ").strip()

    payload: Dict[str, Any] = {}
    if title != "":
        payload["title"] = title
    if author != "":
        payload["author"] = author
    if year_s != "":
        try:
            payload["published_year"] = int(year_s)
        except ValueError:
            print("published_year ignored (not a number).")
    if avail_s != "":
        if avail_s in ("0", "1"):
            payload["available"] = int(avail_s)
        else:
            print("available ignored (must be 0 or 1).")

    if not payload:
        print("Nothing to update.\n")
        return

    status, body = http_request(cfg, "PUT", f"/api/books/{book_id}", payload)
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


def delete_book(cfg: Config) -> None:
    book_id = prompt_int("book id: ")
    confirm = input(f"Are you sure you want to delete book #{book_id}? (y/N): ").strip().lower()
    if confirm != "y":
        print("Canceled.\n")
        return

    status, body = http_request(cfg, "DELETE", f"/api/books/{book_id}")
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


# ---------------- Borrows ----------------

def list_borrows(cfg: Config) -> None:
    page = prompt_int("page (default 1): ", default=1)
    per_page = prompt_int("per_page (default 10, max 50): ", default=10)
    search = prompt_str("search (optional): ", default="")
    status_filter = prompt_str("status (active/returned, optional): ", default="")
    overdue = prompt_str("overdue (0/1, optional): ", default="")
    user_id = prompt_str("user_id (optional): ", default="")
    book_id = prompt_str("book_id (optional): ", default="")

    qs = f"?page={page}&per_page={per_page}"
    if search:
        qs += f"&search={urllib.parse.quote(search)}"
    if status_filter:
        qs += f"&status={urllib.parse.quote(status_filter)}"
    if overdue in ("0", "1"):
        qs += f"&overdue={overdue}"
    if user_id.isdigit():
        qs += f"&user_id={user_id}"
    if book_id.isdigit():
        qs += f"&book_id={book_id}"

    status, body = http_request(cfg, "GET", f"/api/borrows{qs}")
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


def show_borrow(cfg: Config) -> None:
    borrow_id = prompt_int("borrow id: ")
    status, body = http_request(cfg, "GET", f"/api/borrows/{borrow_id}")
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


def create_borrow(cfg: Config) -> None:
    user_id = prompt_int("user_id: ")
    book_id = prompt_int("book_id: ")
    due_days = prompt_int("due_days (default 14): ", default=14)

    payload = {"user_id": user_id, "book_id": book_id, "due_days": due_days}
    status, body = http_request(cfg, "POST", "/api/borrows", payload)
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


def return_borrow(cfg: Config) -> None:
    borrow_id = prompt_int("borrow id: ")
    status, body = http_request(cfg, "POST", f"/api/borrows/{borrow_id}/return", {})
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


def renew_borrow(cfg: Config) -> None:
    borrow_id = prompt_int("borrow id: ")
    extend_days = prompt_int("extend_days (default 7): ", default=7)

    payload = {"extend_days": extend_days}
    status, body = http_request(cfg, "POST", f"/api/borrows/{borrow_id}/renew", payload)
    print(f"\nHTTP {status}\n{pretty_json(body)}\n")


# ---------------- Settings ----------------

def change_config(cfg: Config) -> None:
    base = prompt_str(f"base_url (current: {cfg.base_url}): ", default=cfg.base_url)
    token = prompt_str(f"token (current: {cfg.token}): ", default=cfg.token)
    cfg.base_url = base
    cfg.token = token
    print("Config updated.\n")


def menu() -> None:
    print("Librava CLI")
    print("1) List books (pagination + search)")
    print("2) Show book by id")
    print("3) Create book")
    print("4) Update book (PUT)")
    print("5) Delete book (DELETE)")
    print("6) Settings (base_url/token)")
    print("7) List borrows (pagination + search + filters)")
    print("8) Show borrow by id")
    print("9) Create borrow")
    print("10) Return borrow")
    print("11) Renew borrow")
    print("0) Exit")


def main() -> None:
    cfg = Config()

    if len(sys.argv) >= 2:
        cfg.base_url = sys.argv[1]
    if len(sys.argv) >= 3:
        cfg.token = sys.argv[2]

    while True:
        menu()
        choice = input("Choose: ").strip()

        if choice == "1":
            list_books(cfg)
        elif choice == "2":
            show_book(cfg)
        elif choice == "3":
            create_book(cfg)
        elif choice == "4":
            update_book(cfg)
        elif choice == "5":
            delete_book(cfg)
        elif choice == "6":
            change_config(cfg)
        elif choice == "7":
            list_borrows(cfg)
        elif choice == "8":
            show_borrow(cfg)
        elif choice == "9":
            create_borrow(cfg)
        elif choice == "10":
            return_borrow(cfg)
        elif choice == "11":
            renew_borrow(cfg)
        elif choice == "0":
            print("Bye.")
            return
        else:
            print("Invalid choice.\n")


if __name__ == "__main__":
    main()
