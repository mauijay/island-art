// Island Art Hawaiʻi - Main JavaScript entry point
import '../css/app.css';

// Initialize Island Art Hawaiʻi website
console.log(
  'Island Art Hawaiʻi - Ready! Built with CodeIgniter 4 + Vite + Tailwind CSS v4'
);

// Global functionality for Island Art Hawaiʻi
document.addEventListener('DOMContentLoaded', function () {
  // Initialize website features
  console.log('Island Art Hawaiʻi DOM loaded - ready for interactive features');

  // Mobile menu functionality
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuOpenIcon = document.getElementById('menu-open-icon');
  const menuCloseIcon = document.getElementById('menu-close-icon');

  if (mobileMenuButton && mobileMenu && menuOpenIcon && menuCloseIcon) {
    let isOpen = false;

    mobileMenuButton.addEventListener('click', function () {
      isOpen = !isOpen;

      if (isOpen) {
        // Show menu
        mobileMenu.classList.remove('opacity-0', '-translate-x-full');
        mobileMenu.classList.add('opacity-100', 'translate-x-0');
        menuOpenIcon.classList.add('hidden');
        menuCloseIcon.classList.remove('hidden');
      } else {
        // Hide menu
        mobileMenu.classList.remove('opacity-100', 'translate-x-0');
        mobileMenu.classList.add('opacity-0', '-translate-x-full');
        menuOpenIcon.classList.remove('hidden');
        menuCloseIcon.classList.add('hidden');
      }
    });

    // Close menu when clicking outside
    document.addEventListener('click', function (event) {
      if (
        isOpen &&
        !mobileMenu.contains(event.target) &&
        !mobileMenuButton.contains(event.target)
      ) {
        isOpen = false;
        mobileMenu.classList.remove('opacity-100', 'translate-x-0');
        mobileMenu.classList.add('opacity-0', '-translate-x-full');
        menuOpenIcon.classList.remove('hidden');
        menuCloseIcon.classList.add('hidden');
      }
    });

    // Close menu on window resize (when switching to desktop view)
    window.addEventListener('resize', function () {
      if (window.innerWidth >= 1024 && isOpen) {
        // lg breakpoint
        isOpen = false;
        mobileMenu.classList.remove('opacity-100', 'translate-x-0');
        mobileMenu.classList.add('opacity-0', '-translate-x-full');
        menuOpenIcon.classList.remove('hidden');
        menuCloseIcon.classList.add('hidden');
      }
    });
  }

  // Add any other website-specific functionality here
  // Example: Image galleries, artist interactions, etc.

  // Submit Art Modal functionality
  const submitArtBtn = document.getElementById('submitArtBtn');
  const submitArtModal = document.getElementById('submitArtModal');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const cancelBtn = document.getElementById('cancelBtn');
  const modalOverlay = document.getElementById('modalOverlay');
  const submitArtForm = document.getElementById('submitArtForm');

  if (submitArtBtn && submitArtModal) {
    // Open modal when Submit Art button is clicked
    submitArtBtn.addEventListener('click', function () {
      submitArtModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden'; // Prevent background scrolling
    });

    // Close modal functions
    function closeModal() {
      submitArtModal.classList.add('hidden');
      document.body.style.overflow = 'auto'; // Restore scrolling
      if (submitArtForm) {
        submitArtForm.reset(); // Reset form when closing
        // Reset image preview
        const imagePreview = document.getElementById('image-preview');
        const uploadArea = document.getElementById('upload-area');
        if (imagePreview && uploadArea) {
          imagePreview.classList.add('hidden');
          uploadArea.classList.remove('hidden');
        }
      }
    }

    // Close modal event listeners
    if (closeModalBtn) {
      closeModalBtn.addEventListener('click', closeModal);
    }

    if (cancelBtn) {
      cancelBtn.addEventListener('click', closeModal);
    }

    if (modalOverlay) {
      modalOverlay.addEventListener('click', closeModal);
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function (event) {
      if (
        event.key === 'Escape' &&
        !submitArtModal.classList.contains('hidden')
      ) {
        closeModal();
      }
    });

    // File upload functionality
    const artworkImage = document.getElementById('artwork_image');
    const uploadArea = document.getElementById('upload-area');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const fileName = document.getElementById('file-name');

    if (uploadArea && artworkImage) {
      uploadArea.addEventListener('click', () => artworkImage.click());

      // Drag and drop functionality
      uploadArea.addEventListener('dragover', function (e) {
        e.preventDefault();
        uploadArea.classList.add('border-blue-400', 'bg-blue-50');
      });

      uploadArea.addEventListener('dragleave', function (e) {
        e.preventDefault();
        uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
      });

      uploadArea.addEventListener('drop', function (e) {
        e.preventDefault();
        uploadArea.classList.remove('border-blue-400', 'bg-blue-50');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
          artworkImage.files = files;
          handleFileSelect(files[0]);
        }
      });

      artworkImage.addEventListener('change', function (e) {
        if (e.target.files.length > 0) {
          handleFileSelect(e.target.files[0]);
        }
      });
    }

    function handleFileSelect(file) {
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
          if (previewImg && imagePreview && uploadArea && fileName) {
            previewImg.src = e.target.result;
            fileName.textContent = file.name;
            imagePreview.classList.remove('hidden');
            uploadArea.classList.add('hidden');
          }
        };
        reader.readAsDataURL(file);
      }
    }

    // Show/hide price section based on "for sale" checkbox
    const forSaleCheckbox = document.getElementById('artwork_for_sale');
    const priceSection = document.getElementById('price-section');

    if (forSaleCheckbox && priceSection) {
      forSaleCheckbox.addEventListener('change', function () {
        if (this.checked) {
          priceSection.classList.remove('hidden');
        } else {
          priceSection.classList.add('hidden');
        }
      });
    }

    // Form submission
    if (submitArtForm) {
      submitArtForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submit-text');
        const submitLoading = document.getElementById('submit-loading');

        // Show loading state
        if (submitBtn && submitText && submitLoading) {
          submitBtn.disabled = true;
          submitText.classList.add('hidden');
          submitLoading.classList.remove('hidden');
        }

        try {
          const formData = new FormData(submitArtForm);

          const response = await fetch('/api/submit-artwork', {
            method: 'POST',
            body: formData,
          });

          const result = await response.json();

          if (response.ok && result.success) {
            // Success - show notification and close modal
            showNotification(
              "Artwork submitted successfully! We'll review it and get back to you soon.",
              'success'
            );
            closeModal();
          } else {
            // Error - show error message
            showNotification(
              result.message || 'Failed to submit artwork. Please try again.',
              'error'
            );
          }
        } catch (error) {
          console.error('Submit artwork error:', error);
          showNotification('An error occurred. Please try again.', 'error');
        } finally {
          // Reset loading state
          if (submitBtn && submitText && submitLoading) {
            submitBtn.disabled = false;
            submitText.classList.remove('hidden');
            submitLoading.classList.add('hidden');
          }
        }
      });
    }
  }

  // Newsletter Subscription Modal functionality
  const subscribeNowBtn = document.getElementById('subscribeNowBtn');
  const newsletterModal = document.getElementById('newsletterModal');
  const closeNewsletterBtn = document.getElementById('closeNewsletterBtn');
  const cancelNewsletterBtn = document.getElementById('cancelNewsletterBtn');
  const newsletterOverlay = document.getElementById('newsletterOverlay');
  const newsletterForm = document.getElementById('newsletterForm');

  if (subscribeNowBtn && newsletterModal) {
    // Open modal when Subscribe Now button is clicked
    subscribeNowBtn.addEventListener('click', function () {
      newsletterModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden'; // Prevent background scrolling
    });

    // Close modal functions
    function closeNewsletterModal() {
      newsletterModal.classList.add('hidden');
      document.body.style.overflow = 'auto'; // Restore scrolling
      if (newsletterForm) {
        newsletterForm.reset(); // Reset form when closing
      }
    }

    // Close modal event listeners
    if (closeNewsletterBtn) {
      closeNewsletterBtn.addEventListener('click', closeNewsletterModal);
    }

    if (cancelNewsletterBtn) {
      cancelNewsletterBtn.addEventListener('click', closeNewsletterModal);
    }

    if (newsletterOverlay) {
      newsletterOverlay.addEventListener('click', closeNewsletterModal);
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function (event) {
      if (
        event.key === 'Escape' &&
        !newsletterModal.classList.contains('hidden')
      ) {
        closeNewsletterModal();
      }
    });

    // Form submission
    if (newsletterForm) {
      newsletterForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const subscribeBtn = document.getElementById('subscribeBtn');
        const subscribeText = document.getElementById('subscribe-text');
        const subscribeLoading = document.getElementById('subscribe-loading');

        // Show loading state
        if (subscribeBtn && subscribeText && subscribeLoading) {
          subscribeBtn.disabled = true;
          subscribeText.classList.add('hidden');
          subscribeLoading.classList.remove('hidden');
        }

        try {
          const formData = new FormData(newsletterForm);

          const response = await fetch('/api/subscribe-newsletter', {
            method: 'POST',
            body: formData,
          });

          const result = await response.json();

          if (response.ok && result.success) {
            // Success - show notification and close modal
            showNotification(
              'Successfully subscribed! Welcome to our art community.',
              'success'
            );
            closeNewsletterModal();
          } else {
            // Error - show error message
            showNotification(
              result.message || 'Failed to subscribe. Please try again.',
              'error'
            );
          }
        } catch (error) {
          console.error('Newsletter subscription error:', error);
          showNotification('An error occurred. Please try again.', 'error');
        } finally {
          // Reset loading state
          if (subscribeBtn && subscribeText && subscribeLoading) {
            subscribeBtn.disabled = false;
            subscribeText.classList.remove('hidden');
            subscribeLoading.classList.add('hidden');
          }
        }
      });
    }
  }

  // Simple notification function
  function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all transform translate-x-full ${
      type === 'success'
        ? 'bg-green-500 text-white'
        : type === 'error'
          ? 'bg-red-500 text-white'
          : 'bg-blue-500 text-white'
    }`;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Slide in
    setTimeout(() => {
      notification.classList.remove('translate-x-full');
    }, 100);

    // Slide out and remove after 5 seconds
    setTimeout(() => {
      notification.classList.add('translate-x-full');
      setTimeout(() => {
        document.body.removeChild(notification);
      }, 300);
    }, 5000);
  }
});
