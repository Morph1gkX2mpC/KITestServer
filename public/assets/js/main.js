// Main JavaScript for Web Testing Server

// Utility functions
const Utils = {
    // Display message to user
    showMessage(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.textContent = message;
        
        const container = document.querySelector('.container');
        if (container) {
            container.insertBefore(alertDiv, container.firstChild);
            setTimeout(() => alertDiv.remove(), 5000);
        }
    },

    // Format date
    formatDate(date) {
        return new Date(date).toLocaleString();
    },

    // Generate random ID
    generateId() {
        return Math.random().toString(36).substr(2, 9);
    },

    // Storage helpers
    storage: {
        set(key, value) {
            try {
                localStorage.setItem(key, JSON.stringify(value));
                return true;
            } catch (e) {
                console.error('Storage error:', e);
                return false;
            }
        },
        get(key) {
            try {
                const item = localStorage.getItem(key);
                return item ? JSON.parse(item) : null;
            } catch (e) {
                console.error('Storage error:', e);
                return null;
            }
        },
        remove(key) {
            localStorage.removeItem(key);
        },
        clear() {
            localStorage.clear();
        }
    }
};

// AJAX Helper
const Ajax = {
    // GET request
    get(url, callback) {
        fetch(url)
            .then(response => response.json())
            .then(data => callback(null, data))
            .catch(error => callback(error, null));
    },

    // POST request
    post(url, data, callback) {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => callback(null, data))
        .catch(error => callback(error, null));
    },

    // Form submission
    submitForm(formElement, url, callback) {
        const formData = new FormData(formElement);
        
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => callback(null, data))
        .catch(error => callback(error, null));
    }
};

// DOM Ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('Web Testing Server - JavaScript Loaded');
    
    // Highlight active navigation
    highlightActiveNav();
    
    // Add smooth scrolling
    addSmoothScrolling();
    
    // Initialize tooltips if any
    initializeTooltips();
});

// Highlight active navigation based on current page
function highlightActiveNav() {
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.main-nav a');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPage || (currentPage === '' && href === 'index.html')) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

// Add smooth scrolling to anchor links
function addSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Initialize tooltips
function initializeTooltips() {
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(element => {
        element.addEventListener('mouseenter', showTooltip);
        element.addEventListener('mouseleave', hideTooltip);
    });
}

function showTooltip(e) {
    const text = e.target.getAttribute('data-tooltip');
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.textContent = text;
    tooltip.style.position = 'absolute';
    tooltip.style.background = '#333';
    tooltip.style.color = 'white';
    tooltip.style.padding = '5px 10px';
    tooltip.style.borderRadius = '5px';
    tooltip.style.fontSize = '14px';
    tooltip.style.zIndex = '1000';
    
    document.body.appendChild(tooltip);
    
    const rect = e.target.getBoundingClientRect();
    tooltip.style.left = rect.left + 'px';
    tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
    
    e.target._tooltip = tooltip;
}

function hideTooltip(e) {
    if (e.target._tooltip) {
        e.target._tooltip.remove();
        delete e.target._tooltip;
    }
}

// Form validation helper
function validateForm(formId, rules) {
    const form = document.getElementById(formId);
    if (!form) return false;
    
    let isValid = true;
    const formData = new FormData(form);
    
    for (const [field, rule] of Object.entries(rules)) {
        const value = formData.get(field);
        
        if (rule.required && !value) {
            showFieldError(field, 'This field is required');
            isValid = false;
        } else if (rule.pattern && !rule.pattern.test(value)) {
            showFieldError(field, rule.message || 'Invalid format');
            isValid = false;
        } else if (rule.minLength && value.length < rule.minLength) {
            showFieldError(field, `Minimum ${rule.minLength} characters required`);
            isValid = false;
        } else {
            clearFieldError(field);
        }
    }
    
    return isValid;
}

function showFieldError(fieldName, message) {
    const field = document.querySelector(`[name="${fieldName}"]`);
    if (!field) return;
    
    field.style.borderColor = 'red';
    
    let error = field.parentElement.querySelector('.field-error');
    if (!error) {
        error = document.createElement('div');
        error.className = 'field-error';
        error.style.color = 'red';
        error.style.fontSize = '14px';
        error.style.marginTop = '5px';
        field.parentElement.appendChild(error);
    }
    error.textContent = message;
}

function clearFieldError(fieldName) {
    const field = document.querySelector(`[name="${fieldName}"]`);
    if (!field) return;
    
    field.style.borderColor = '';
    const error = field.parentElement.querySelector('.field-error');
    if (error) error.remove();
}

// Export utilities for use in other scripts
window.Utils = Utils;
window.Ajax = Ajax;
window.validateForm = validateForm;
