// Define the inactivity limit (in seconds)
const inactivityLimit = 300;
let inactivityTimer;
let countdownTimer;

// Reset both the inactivity timer and hide the countdown if it is showing
function resetInactivityTimer() {
  // Clear existing timers
  clearTimeout(inactivityTimer);
  clearInterval(countdownTimer);
  countdownTimer = null;

  // Hide the countdown display if visible
  document.getElementById("countdown").style.display = "none";

  // Start a new inactivity timer
  inactivityTimer = setTimeout(startCountdown, inactivityLimit * 1000);
}

// Start the 30-second countdown that will logout the user if no activity occurs
function startCountdown() {
  let timeLeft = inactivityLimit;
  const countdownEl = document.getElementById("countdown");
  countdownEl.style.display = "block";
  countdownEl.textContent =
    "Logging out in " + timeLeft + " seconds due to inactivity.";

  // Update the countdown every second
  countdownTimer = setInterval(() => {
    timeLeft--;
    if (timeLeft <= 0) {
      clearInterval(countdownTimer);
      // Redirect to the same page with a GET parameter to trigger logout
      window.location.href = "dashboard.php?logout=1";
    } else {
      countdownEl.textContent =
        "Logging out in " + timeLeft + " seconds due to inactivity.";
    }
  }, 1000);
}

// List of events that indicate activity and reset the timer
const activityEvents = ["mousemove", "keydown", "scroll", "touchstart"];

// Attach event listeners to each activity event
activityEvents.forEach((eventName) => {
  document.addEventListener(eventName, resetInactivityTimer, false);
});

// Start the timer as soon as the page loads
window.onload = resetInactivityTimer;
