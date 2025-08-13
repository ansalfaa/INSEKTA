document.addEventListener("DOMContentLoaded", () => {
  const sidebarToggle = document.getElementById("sidebar-toggle")
  const sidebarLeft = document.getElementById("sidebar-left")
  const sidebarOverlay = document.getElementById("sidebar-overlay")
  const dashboardWrapper = document.getElementById("dashboard-wrapper")

  if (sidebarToggle && sidebarLeft && sidebarOverlay && dashboardWrapper) {
    sidebarToggle.addEventListener("click", () => {
      dashboardWrapper.classList.toggle("sidebar-open")
    })

    sidebarOverlay.addEventListener("click", () => {
      dashboardWrapper.classList.remove("sidebar-open")
    })

    // Close sidebar if window resized to desktop from mobile with sidebar open
    window.addEventListener("resize", () => {
      if (window.innerWidth >= 768) {
        // md breakpoint
        dashboardWrapper.classList.remove("sidebar-open")
      }
    })
  } else {
    console.warn("One or more sidebar elements not found. Sidebar toggle will not be active.")
  }
})
