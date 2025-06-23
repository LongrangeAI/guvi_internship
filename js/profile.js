document.addEventListener("DOMContentLoaded", async () => {
  const sessionId = localStorage.getItem("session_id");

  if (!sessionId) {
    alert("Session not found! Please login again.");
    window.location.href = "login.html";
    return;
  }

  const response = await fetch(`php/profile.php?session_id=${sessionId}`);
  const result = await response.json();

  if (result.status === "success") {
    document.getElementById("username").innerText = result.data.name;
    document.getElementById("useremail").innerText = result.data.email;
  } else {
    alert("Session expired or invalid.");
    localStorage.removeItem("session_id");
    window.location.href = "login.html";
  }
});
