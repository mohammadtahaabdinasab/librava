-- Librava schema for SQLite
-- This schema works with SQLite3 and is compatible with the Librava MVC framework

CREATE TABLE IF NOT EXISTS books (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    author TEXT,
    published_year INTEGER,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data for testing
INSERT OR IGNORE INTO books (id, title, author, published_year, created_at) VALUES
(1, '1984', 'George Orwell', 1949, datetime('now')),
(2, 'To Kill a Mockingbird', 'Harper Lee', 1960, datetime('now')),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, datetime('now'));
