if (
  location.pathname == "/" ||
  location.pathname == "/en/" ||
  location.pathname == "/tr/"
) {
  window.addEventListener("load", () => {
    document.querySelector(".preloader-wrap").classList.add("gone");
    setTimeout(() => {
      document.querySelector(".preloader-wrap").style.display = "none";
    }, 200);
    document.getElementById("svg-logo").id = "logotip";
    setTimeout(() => {
      document.querySelector(".entry-anima").classList.add("gone");
      document.querySelector(".wrapper").classList.add("active-scroll");
      document.querySelector(".site-header").classList.add("header-active");
    }, 1500);
    setTimeout(() => {
      document.querySelector(".entry-anima").style.display = "none";
    }, 2500);
  });
} else {
  window.addEventListener("load", () => {
    document.querySelector(".preloader-wrap").classList.add("gone");
    setTimeout(() => {
      document.querySelector(".preloader-wrap").style.display = "none";
      document.querySelector(".wrapper").classList.add("active-scroll");
      document.querySelector(".site-header").classList.add("header-active");
    }, 200);
  });
}

if (typeof jQuery !== "undefined") {
  wrapper = jQuery(".tabs");
  tabs = wrapper.find(".tab");
  tabToggle = wrapper.find(".tab-toggle");

  function openTab() {
    let content = jQuery(this).parent().next(".content"),
      activeItems = wrapper.find(".active");

    if (!jQuery(this).hasClass("active")) {
      jQuery(this).add(content).add(activeItems).toggleClass("active");
      wrapper.css("min-height", content.outerHeight());
    }
  }

  tabToggle.on("click", openTab);

  window.onload = function () {
    tabToggle.first().trigger("click");
  };
}

const observableItems = document.querySelectorAll(".hero-paragraph");

const options = {
  threshold: 0,
  rootMargin: "0px 0px -30% 0px",
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.intersectionRatio > 0) {
      entry.target.classList.add("animation-once");
      observer.unobserve(entry.target);
    }
  });
}, options);

observableItems.forEach((item) => {
  observer.observe(item);
});

window.addEventListener("scroll", () => {
  if (window.scrollY == 0) {
    document.querySelector(".lang-menu").classList.remove("no-top-scroll");
  } else {
    document.querySelector(".lang-menu").classList.add("no-top-scroll");
  }
});

let navSlide = () => {
  const burger = document.querySelector(".burger");
  const nav = document.querySelector(".menu");
  const navLinks = document.querySelectorAll(".menu li");

  burger.addEventListener("click", () => {
    nav.classList.toggle("menu-active");
    navLinks.forEach((link, index) => {
      if (link.style.animation) {
        link.style.animation = "";
      } else {
        link.style.animation = `navLinkFade 0.5s ease forwards ${
          index / 7 + 1.1
        }s`;
      }
    });
    burger.classList.toggle("toggle");
    // document.querySelector(".wrapper").classList.toggle("active-scroll");
  });
};
navSlide();
