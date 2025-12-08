<?php
/**
 * Contact page view
 */
?>
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, #606c38 0%, #283618 100%);">
    <div class="container">
        <h1 class="text-white display-4 fw-bold">Contact Us</h1>
        <p class="text-light lead">We'd love to hear from you</p>
    </div>
</section>

<!-- Contact Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h5 class="card-title mb-4">Send us a Message</h5>
                        <form id="contactForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="">Choose a subject...</option>
                                    <option value="support">Technical Support</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="contact-info">
                    <div class="contact-item mb-4">
                        <i class="fas fa-map-marker-alt fa-2x mb-3" style="color: #dda15e;"></i>
                        <h6>Address</h6>
                        <p class="text-muted">
                            Tehran, Iran<br>
                            Library Management Division
                        </p>
                    </div>

                    <div class="contact-item mb-4">
                        <i class="fas fa-phone fa-2x mb-3" style="color: #dda15e;"></i>
                        <h6>Phone</h6>
                        <p class="text-muted">
                            <a href="tel:+98-21-1234-5678" class="text-decoration-none">+98 (21) 1234-5678</a><br>
                            <span class="small">Mon - Fri, 9:00 AM - 5:00 PM</span>
                        </p>
                    </div>

                    <div class="contact-item mb-4">
                        <i class="fas fa-envelope fa-2x mb-3" style="color: #dda15e;"></i>
                        <h6>Email</h6>
                        <p class="text-muted">
                            <a href="mailto:info@librava.com" class="text-decoration-none">info@librava.com</a><br>
                            <a href="mailto:support@librava.com" class="text-decoration-none">support@librava.com</a>
                        </p>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-clock fa-2x mb-3" style="color: #dda15e;"></i>
                        <h6>Business Hours</h6>
                        <p class="text-muted">
                            Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday: 10:00 AM - 4:00 PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h6 class="card-title mb-3">Follow Us</h6>
                        <a href="#" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fab fa-github"></i> GitHub
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-info me-2">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-danger">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Frequently Asked Questions</h2>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How do I get started with Librava?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can get started by visiting our documentation or creating an account on the platform. We provide a comprehensive setup guide for both web and mobile applications.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Is there an API for integration?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! Librava provides a complete REST API with 25+ endpoints. Check our API documentation for integration details and Android/mobile app examples.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                What languages does Librava support?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Librava currently supports English and Persian with full RTL/LTR layout support. Additional languages can be easily added.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                How is my data protected?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We use JWT authentication, bcrypt password hashing, role-based access control, and encrypted data storage to ensure maximum security.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Is there mobile app support?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Absolutely! We provide complete Android integration guides with Retrofit examples. iOS support is coming soon.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    // Show success message (in production, send to server)
    alert('Thank you for your message! We will get back to you soon.');
    this.reset();
});
</script>

<style>
    .contact-info {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 8px;
    }
    
    .contact-item {
        border-bottom: 1px solid #dee2e6;
    }
    
    .contact-item:last-child {
        border-bottom: none;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: #fef9ef;
        color: #606c38;
    }
</style>
