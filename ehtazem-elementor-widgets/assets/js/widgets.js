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
  // Initialize Contact Form
  const contactForm = document.getElementById("contactForm");
  if (contactForm) {
    initializeContactForm(contactForm);
  }

  // Initialize Intermediaries Form
  const intermediariesForm = document.getElementById("intermediariesForm");
  if (intermediariesForm) {
    initializeIntermediariesForm(intermediariesForm);
  }
});

/**
 * Initialize Contact Form with AJAX submission
 */
function initializeContactForm(form) {
  const inputs = form.querySelectorAll(".form-control");

  // Add animation on page load
  const formCard = document.querySelector(".form-card");
  if (formCard) {
    formCard.style.opacity = "0";
    formCard.style.transform = "translateY(30px)";

    setTimeout(() => {
      formCard.style.transition = "all 0.6s ease";
      formCard.style.opacity = "1";
      formCard.style.transform = "translateY(0)";
    }, 100);
  }

  // Form submission with AJAX
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const fullName = document.getElementById("full_name").value;
    const phone = document.getElementById("phone").value;
    const question = document.getElementById("question").value;
    const nonce = form.querySelector('input[name="nonce"]').value;
    const formType = form.querySelector('input[name="form_type"]').value;

    // Validate inputs
    if (fullName.trim() === "" || phone.trim() === "" || question.trim() === "") {
      showFormMessage(form, "من فضلك املأ جميع الحقول المطلوبة", "error");
      return;
    }

    // Phone validation
    if (phone.length < 10) {
      showFormMessage(form, "رقم الهاتف غير صحيح (يجب أن يكون 10 أرقام على الأقل)", "error");
      return;
    }

    // Get submit button
    const btn = form.querySelector(".submit-btn");
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = "جاري الإرسال...";

    // Prepare form data
    const formData = new FormData();
    formData.append("action", "ehtazem_submit_form");
    formData.append("nonce", nonce);
    formData.append("form_type", formType);
    formData.append("full_name", fullName);
    formData.append("phone", phone);
    formData.append("question", question);

    // Send AJAX request
    fetch(ehtazemAjax.ajaxurl, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          showFormMessage(form, "تم الإرسال بنجاح ✓", "success");
          form.reset();
          btn.innerHTML = originalText;
          btn.disabled = false;
        } else {
          showFormMessage(form, data.data.message || "حدث خطأ، يرجى المحاولة مرة أخرى", "error");
          btn.innerHTML = originalText;
          btn.disabled = false;
        }
      })
      .catch((error) => {
        console.error("Form submission error:", error);
        showFormMessage(form, "حدث خطأ في الاتصال، يرجى المحاولة مرة أخرى", "error");
        btn.innerHTML = originalText;
        btn.disabled = false;
      });
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
  const phoneInput = form.querySelector("#phone");
  if (phoneInput) {
    phoneInput.addEventListener("input", function (e) {
      this.value = this.value.replace(/[^0-9]/g, "");
    });
  }
}

/**
 * Initialize Intermediaries Form with AJAX submission
 */
function initializeIntermediariesForm(form) {
  const inputs = form.querySelectorAll(".form-control");

  // Form submission with AJAX
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const fullName = document.getElementById("full_name").value;
    const phone = document.getElementById("phone").value;
    const company = document.getElementById("company").value;
    const region = document.getElementById("region").value;
    const details = document.getElementById("details").value;
    const nonce = form.querySelector('input[name="nonce"]').value;
    const formType = form.querySelector('input[name="form_type"]').value;

    // Validate required inputs
    if (fullName.trim() === "" || phone.trim() === "") {
      showFormMessage(form, "من فضلك املأ جميع الحقول المطلوبة", "error");
      return;
    }

    // Phone validation
    if (phone.length < 10) {
      showFormMessage(form, "رقم الهاتف غير صحيح (يجب أن يكون 10 أرقام على الأقل)", "error");
      return;
    }

    // Get submit button
    const btn = form.querySelector(".btn-submit");
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = "جاري الإرسال...";

    // Prepare form data
    const formData = new FormData();
    formData.append("action", "ehtazem_submit_form");
    formData.append("nonce", nonce);
    formData.append("form_type", formType);
    formData.append("full_name", fullName);
    formData.append("phone", phone);
    formData.append("company", company);
    formData.append("region", region);
    formData.append("details", details);

    // Send AJAX request
    fetch(ehtazemAjax.ajaxurl, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          showFormMessage(form, "تم الإرسال بنجاح ✓", "success");
          form.reset();
          btn.innerHTML = originalText;
          btn.disabled = false;
        } else {
          showFormMessage(form, data.data.message || "حدث خطأ، يرجى المحاولة مرة أخرى", "error");
          btn.innerHTML = originalText;
          btn.disabled = false;
        }
      })
      .catch((error) => {
        console.error("Form submission error:", error);
        showFormMessage(form, "حدث خطأ في الاتصال، يرجى المحاولة مرة أخرى", "error");
        btn.innerHTML = originalText;
        btn.disabled = false;
      });
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
  const phoneInput = form.querySelector("#phone");
  if (phoneInput) {
    phoneInput.addEventListener("input", function (e) {
      this.value = this.value.replace(/[^0-9]/g, "");
    });
  }
}

/**
 * Show form message (success or error)
 */
function showFormMessage(form, message, type) {
  // Remove existing message
  const existingMessage = form.querySelector(".form-message");
  if (existingMessage) {
    existingMessage.remove();
  }

  // Create message element
  const messageDiv = document.createElement("div");
  messageDiv.className = `form-message form-message-${type}`;
  messageDiv.style.cssText = `
    padding: 15px;
    margin: 15px 0;
    border-radius: 5px;
    text-align: center;
    font-weight: 600;
    animation: slideIn 0.3s ease;
    ${type === "success" ? "background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;" : ""}
    ${type === "error" ? "background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;" : ""}
  `;
  messageDiv.textContent = message;

  // Insert message before submit button
  const submitBtn = form.querySelector("button[type='submit']");
  submitBtn.parentElement.insertBefore(messageDiv, submitBtn);

  // Auto remove after 5 seconds
  setTimeout(() => {
    messageDiv.style.animation = "slideOut 0.3s ease";
    setTimeout(() => {
      messageDiv.remove();
    }, 300);
  }, 5000);
}
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