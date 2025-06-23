document.querySelector("form").addEventListener("submit", async (e) => {
  e.preventDefault();

  const form = e.target;
  const name = form.name.value.trim();
  const email = form.email.value.trim();
  const password = form.password.value.trim();

  if (!name || !email || !password) {
    alert("All fields are required!");
    return;
  }

  const formData = new FormData(form);

  const response = await fetch("php/register.php", {
    method: "POST",
    body: formData,
  });

  const text = await response.text();
  document.write(text); // Let PHP redirect
});
