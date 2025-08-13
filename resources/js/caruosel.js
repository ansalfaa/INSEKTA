document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.getElementById("feature-carousel")
  if (!carousel) return // Exit if carousel element is not found

  const slides = carousel.querySelectorAll("[data-slide-index]")
  const dotsContainer = document.getElementById("carousel-dots")
  const prevButton = document.getElementById("prev-slide")
  const nextButton = document.getElementById("next-slide")

  if (!slides.length || !dotsContainer || !prevButton || !nextButton) {
    console.warn("Carousel elements not found. Skipping carousel initialization.")
    return
  }

  const getSlideWidth = () => carousel.clientWidth
  let slideWidth = getSlideWidth()
  let currentSlideIndex = 0
  let slideTimer
  const autoSlideInterval = 4000 // 4 detik

  window.addEventListener("resize", () => {
    slideWidth = getSlideWidth()
    goToSlide(currentSlideIndex, false) // false to not use smooth scroll on resize
  })

  // 1. Generate Dots
  slides.forEach((_, index) => {
    const dot = document.createElement("button")
    dot.classList.add(
      "w-3",
      "h-3",
      "rounded-full",
      "bg-slate-300",
      "hover:bg-blue-600",
      "transition-colors",
      "duration-200",
    )
    dot.setAttribute("data-dot-index", index.toString()) // Convert index to string
    dotsContainer.appendChild(dot)
    dot.addEventListener("click", () => {
      goToSlide(index)
      resetAutoSlide()
    })
  })

  const dots = dotsContainer.querySelectorAll("button")

  // 2. Update Active Dot
  const updateActiveDot = () => {
    dots.forEach((dot, index) => {
      if (index === currentSlideIndex) {
        dot.classList.add("bg-blue-800") // Changed to blue-800 for active dot
        dot.classList.remove("bg-slate-300")
      } else {
        dot.classList.remove("bg-blue-800")
        dot.classList.add("bg-slate-300")
      }
    })
  }

  // 3. Go to Slide Function
  const goToSlide = (index, smooth = true) => {
    currentSlideIndex = index
    if (currentSlideIndex < 0) {
      currentSlideIndex = slides.length - 1
    } else if (currentSlideIndex >= slides.length) {
      currentSlideIndex = 0
    }
    carousel.scrollTo({
      left: currentSlideIndex * slideWidth,
      behavior: smooth ? "smooth" : "auto",
    })
    updateActiveDot()
  }

  // 4. Navigation Button Handlers
  prevButton.addEventListener("click", () => {
    goToSlide(currentSlideIndex - 1)
    resetAutoSlide()
  })
  nextButton.addEventListener("click", () => {
    goToSlide(currentSlideIndex + 1)
    resetAutoSlide()
  })

  // 5. Auto Slide Function
  const startAutoSlide = () => {
    slideTimer = setInterval(() => {
      goToSlide(currentSlideIndex + 1)
    }, autoSlideInterval)
  }

  const resetAutoSlide = () => {
    clearInterval(slideTimer)
    startAutoSlide()
  }

  // 6. Pause on Hover
  carousel.addEventListener("mouseenter", () => {
    clearInterval(slideTimer)
  })
  carousel.addEventListener("mouseleave", () => {
    resetAutoSlide()
  })

  // Initial setup
  updateActiveDot()
  startAutoSlide()
})
