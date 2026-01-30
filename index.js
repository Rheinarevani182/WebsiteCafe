const form = document.getElementById("loginForm");
const errorMsg = document.getElementById("errorMsg");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    errorMsg.textContent = "Email dan password wajib diisi!";
    errorMsg.classList.remove("hidden");
    return;
  }

  try {
    const res = await fetch("login.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password }),
    });

    const data = await res.json();

    if (data.status === "success") {
      localStorage.setItem("loggedIn", "true");
      window.location.href = "cafe.html";
    } else {
      errorMsg.textContent = data.message;
      errorMsg.classList.remove("hidden");
    }
  } catch (err) {
    errorMsg.textContent = "Gagal terhubung ke server.";
    errorMsg.classList.remove("hidden");
  }
});
