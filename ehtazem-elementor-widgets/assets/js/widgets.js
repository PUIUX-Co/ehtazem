document.addEventListener("DOMContentLoaded", () => {
  /**
   * دالة لإنشاء سلايدر جديد
   * @param {string} selector - كلاس/سلكتور السلايدر
   * @param {object} options - إعدادات مخصصة
   */
  function initSwiper(selector, options = {}) {
    const element = document.querySelector(selector);
    if (!element) {
      console.warn(`❌ Swiper element not found: ${selector}`);
      return null;
    }

    try {
      const swiper = new Swiper(element, {
        spaceBetween: 40,
        loop: true,
        centeredSlides: false,
        grabCursor: true,
        keyboard: { enabled: true },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        breakpoints: {
          0: { slidesPerView: 1 },
          576: { slidesPerView: 2 },
          992: { slidesPerView: 5 },
        },
        ...options, // دمج الإعدادات المخصصة مع الافتراضية
      });

      console.info(`✅ Swiper initialized: ${selector}`, swiper);
      return swiper;
    } catch (error) {
      console.error(`❌ Swiper init failed: ${selector}`, error);
      return null;
    }
  }

  // تهيئة الـ About Us Swiper
  initSwiper(".aboutUs-images", {
    navigation: {
      nextEl: ".aboutUs-next",
      prevEl: ".aboutUs-prev",
    },
  });

  // مثال لسلايدر تاني لو عايز تضيفه
  // initSwiper(".products-slider", {
  //   navigation: {
  //     nextEl: ".products-next",
  //     prevEl: ".products-prev",
  //   },
  //   autoplay: { delay: 3000 },
  // });
});
// Initialize accordion with custom animations
document.addEventListener("DOMContentLoaded", function () {
  const accordionButtons = document.querySelectorAll(".accordion-button");
  const accordionItems = document.querySelectorAll(".accordion-item");

  // Add click event listeners to each accordion button
  accordionButtons.forEach((button, index) => {
    button.addEventListener("click", function () {
      // Add pulse animation to clicked item
      const item = this.closest(".accordion-item");
      item.style.animation = "pulse 0.3s ease";

      setTimeout(() => {
        item.style.animation = "";
      }, 300);
    });
  });

  // Smooth scroll animation when accordion opens
  const accordionCollapses = document.querySelectorAll(".accordion-collapse");
  accordionCollapses.forEach((collapse) => {
    collapse.addEventListener("shown.bs.collapse", function () {
      const item = this.closest(".accordion-item");
      const offset = 100;
      const elementPosition =
        item.getBoundingClientRect().top + window.pageYOffset;
      const offsetPosition = elementPosition - offset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });
    });
  });

  // Add entrance animation to FAQ items
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.style.opacity = "1";
          entry.target.style.transform = "translateY(0)";
        }, index * 100);
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Initially hide items for animation
  accordionItems.forEach((item) => {
    item.style.opacity = "0";
    item.style.transform = "translateY(20px)";
    item.style.transition = "all 0.5s ease";
    observer.observe(item);
  });

  // Track FAQ interactions
  accordionButtons.forEach((button, index) => {
    button.addEventListener("click", function () {
      const questionText = this.textContent.trim();
      console.log(`FAQ Interaction: Question ${index + 1} - ${questionText}`);
    });
  });

  // Add keyboard navigation enhancement
  document.addEventListener("keydown", function (e) {
    const focusedElement = document.activeElement;

    if (focusedElement.classList.contains("accordion-button")) {
      const currentItem = focusedElement.closest(".accordion-item");
      const allItems = Array.from(accordionItems);
      const currentIndex = allItems.indexOf(currentItem);

      if (e.key === "ArrowDown" && currentIndex < allItems.length - 1) {
        e.preventDefault();
        allItems[currentIndex + 1].querySelector(".accordion-button").focus();
      } else if (e.key === "ArrowUp" && currentIndex > 0) {
        e.preventDefault();
        allItems[currentIndex - 1].querySelector(".accordion-button").focus();
      }
    }
  });

  // Add count animation to header
  const faqTitle = document.querySelector(".faq-title");
  const totalQuestions = accordionItems.length;

  // Create a counter element
  /*const counter = document.createElement('span');
    counter.style.fontSize = '20px';
    counter.style.color = '#6c63ff';
    counter.style.display = 'block';
    counter.style.marginTop = '10px';
    counter.style.fontWeight = '400';
    
    
    faqTitle.parentNode.insertBefore(counter, faqTitle.nextSibling);*/
});

// Add pulse animation keyframe
const style = document.createElement("style");
style.textContent = `
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.02); }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("contactForm");
  const inputs = form.querySelectorAll(".form-control");

  // Add animation on page load
  const formCard = document.querySelector(".form-card");
  formCard.style.opacity = "0";
  formCard.style.transform = "translateY(30px)";

  setTimeout(() => {
    formCard.style.transition = "all 0.6s ease";
    formCard.style.opacity = "1";
    formCard.style.transform = "translateY(0)";
  }, 100);

  // Animate background cards
  const bgCards = document.querySelectorAll(".bg-card");
  bgCards.forEach((card, index) => {
    card.style.opacity = "0";
    setTimeout(() => {
      card.style.transition = "all 0.8s ease";
      card.style.opacity = "1";
    }, 300 + index * 200);
  });

  // Form validation and submission
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const fullName = document.getElementById("fullName").value;
    const phone = document.getElementById("phone").value;
    const question = document.getElementById("question").value;

    // Validate inputs
    if (
      fullName.trim() === "" ||
      phone.trim() === "" ||
      question.trim() === ""
    ) {
      alert("من فضلك املأ جميع الحقول");
      return;
    }

    // Phone validation (basic)
    if (phone.length < 10) {
      alert("رقم الهاتف غير صحيح");
      return;
    }

    // Animate button on submit
    const btn = form.querySelector(".submit-btn");
    btn.style.transform = "scale(0.95)";
    btn.innerHTML = "جاري الإرسال...";

    // Simulate form submission
    setTimeout(() => {
      btn.style.transform = "scale(1)";
      btn.innerHTML = "تم الإرسال ✓";
      btn.style.background = "#00402E";

      console.log("Form Data:", {
        fullName: fullName,
        phone: phone,
        question: question,
      });

      // Reset form after 2 seconds
      setTimeout(() => {
        form.reset();
        btn.innerHTML = "إرسال";
        btn.style.background = "#00402E";
      }, 2000);
    }, 1000);
  });

  // Add focus animation to inputs
  inputs.forEach((input) => {
    input.addEventListener("focus", function () {
      this.parentElement.style.transform = "translateX(-3px)";
      this.parentElement.style.transition = "transform 0.3s ease";
    });

    input.addEventListener("blur", function () {
      this.parentElement.style.transform = "translateX(0)";
    });
  });

  // Phone number formatting
  const phoneInput = document.getElementById("phone");
  phoneInput.addEventListener("input", function (e) {
    // Only allow numbers
    this.value = this.value.replace(/[^0-9]/g, "");
  });
});
document.addEventListener("DOMContentLoaded", function () {
  AOS.init({
    duration: 650,
    
  });
});

/*document.addEventListener('DOMContentLoaded', function() {
  // Animate the pseudo-elements using CSS class toggle
  ScrollTrigger.create({
      trigger: '.contactus-section',
      start: 'top 70%',
      end: 'bottom 30%',
      onEnter: () => {
          document.querySelector('.contacuUs-form-container').classList.add('animate-decorations');
      },
      onLeaveBack: () => {
          document.querySelector('.contacuUs-form-container').classList.remove('animate-decorations');
      }
  });
  
  // Animate the form card itself
  gsap.from('.form-card', {
      scrollTrigger: {
          trigger: '.contactus-section',
          start: 'top 70%',
          toggleActions: 'play none none reverse',
      },
      opacity: 0,
      y: 50,
      duration: 0.8,
      ease: 'power3.out'
  });

  // Animate decorative images
  gsap.from('.conactus-deco-up-img', {
      scrollTrigger: {
          trigger: '.contactus-section',
          start: 'top 70%',
          toggleActions: 'play none none reverse',
      },
      opacity: 0,
      scale: 0.5,
      rotation: -180,
      duration: 1,
      ease: 'back.out(1.7)'
  });

  gsap.from('.conactus-deco-bottom-img', {
      scrollTrigger: {
          trigger: '.contactus-section',
          start: 'top 70%',
          toggleActions: 'play none none reverse',
      },
      opacity: 0,
      scale: 0.5,
      rotation: 180,
      duration: 1,
      ease: 'back.out(1.7)'
  });

  // Animate header
  gsap.from('.contactus-header', {
      scrollTrigger: {
          trigger: '.contactus-section',
          start: 'top 80%',
          toggleActions: 'play none none reverse',
      },
      opacity: 0,
      y: -30,
      duration: 0.8,
      ease: 'power2.out'
  });

  // Animate form elements
  gsap.from('.form-group', {
      scrollTrigger: {
          trigger: '.form-card',
          start: 'top 60%',
          toggleActions: 'play none none reverse',
      },
      opacity: 0,
      x: -30,
      stagger: 0.15,
      duration: 0.6,
      ease: 'power2.out'
  });

  gsap.from('.submit-btn', {
      scrollTrigger: {
          trigger: '.form-card',
          start: 'top 50%',
          toggleActions: 'play none none reverse',
      },
      opacity: 0,
      scale: 0.8,
      duration: 0.5,
      delay: 0.5,
      ease: 'back.out(1.7)'
  });

  // Form submission handler
  document.getElementById('contactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('تم إرسال النموذج بنجاح! ✅');
  });
});*/
 // Intersection Observer to trigger animations on scroll
 const socialIcons = document.querySelector('.social-icons');
 const observer = new IntersectionObserver((entries, observer) => {
     entries.forEach(entry => {
         if (entry.isIntersecting) {
             // Add animate class to trigger animations
             socialIcons.classList.add('animate');
             // Stop observing after animation triggers
             observer.unobserve(socialIcons);
         }
     });
 }, {
     threshold: 0.5 // Trigger when 50% of the element is in view
 });

 // Start observing the social-icons container
 observer.observe(socialIcons);

/* ============================================
   EHTAZEM FORM AJAX SUBMISSION
   Handles all forms with class 'ehtazem-form'
   ============================================ */
document.addEventListener('DOMContentLoaded', function() {
    const ehtazemForms = document.querySelectorAll('.ehtazem-form');

    ehtazemForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = form.querySelector('[type="submit"], .submit-btn');
            const messagesDiv = form.querySelector('.form-messages');
            const formData = new FormData(form);

            // Get form type from hidden input
            const formType = formData.get('form_type') || 'contact';

            // Add action and nonce
            formData.append('action', 'ehtazem_submit_form');
            formData.append('nonce', form.querySelector('[name="nonce"]')?.value || '');

            // Disable button and show loading
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'جاري الإرسال...';
            }

            // Send AJAX request
            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (messagesDiv) {
                    messagesDiv.style.display = 'block';

                    if (data.success) {
                        messagesDiv.innerHTML = `<div class="alert alert-success">${data.data.message || 'تم الإرسال بنجاح!'}</div>`;
                        form.reset();

                        // Success button state
                        if (submitBtn) {
                            submitBtn.textContent = 'تم الإرسال ✓';
                            submitBtn.style.background = '#4EA62F';
                        }
                    } else {
                        messagesDiv.innerHTML = `<div class="alert alert-danger">${data.data.message || 'حدث خطأ، حاول مرة أخرى'}</div>`;

                        // Reset button
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = formType === 'intermediaries' ? 'إرسال' : 'إرسال';
                        }
                    }
                }

                // Auto-hide message after 5 seconds
                setTimeout(() => {
                    if (messagesDiv) {
                        messagesDiv.style.display = 'none';
                    }

                    // Reset button to original state
                    if (submitBtn && data.success) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = formType === 'intermediaries' ? 'إرسال' : 'إرسال';
                        submitBtn.style.background = '';
                    }
                }, 5000);
            })
            .catch(error => {
                console.error('Form submission error:', error);

                if (messagesDiv) {
                    messagesDiv.style.display = 'block';
                    messagesDiv.innerHTML = '<div class="alert alert-danger">حدث خطأ في الاتصال، حاول مرة أخرى</div>';
                }

                // Reset button
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = formType === 'intermediaries' ? 'إرسال' : 'إرسال';
                }
            });
        });
    });
});