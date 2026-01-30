const form = document.getElementById("registerForm");
const msg = document.getElementById("msg");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = form.email.value.trim();
  const password = form.password.value.trim();

  if (password.length < 6) {
    msg.textContent = "Password minimal 6 karakter!";
    msg.style.color = "red";
    return;
  }

  try {
    const res = await fetch("register.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password })
    });

    const data = await res.json();
    msg.textContent = data.message;
    msg.style.color = data.status === "success" ? "green" : "red";

    if (data.status === "success") {
      setTimeout(() => (window.location.href = "index.html"), 1500);
    }
  } catch (err) {
    msg.textContent = "Gagal terhubung ke server!";
    msg.style.color = "red";
  }
});
