const url = new URL(window.location.href);

const params = new URLSearchParams(url.search);

const q = params.get("q");

console.log(q);

const fetchUserData = async () => {
  try {
    const response = await fetch(`../controller/getUser.php?q=${q}`, {
      method: "GET",
    });

    const data = await response.json();
    console.log(data);
    Object.keys(data.data).forEach((element) => {
      if (element === "userImage") {
        document.getElementById('selectedImage').innerText =data.data[element];
      } else {
        document.getElementById(element).value = data.data[element];
      }
    });
  } catch (error) {
    console.log(error);
  }
};
fetchUserData();

const updateUserFrom = async (e) => {
  e.preventDefault();
  const formData = new FormData(e.target);
  const fileInput = document.getElementById('userImage');
    formData.append('file', fileInput.files[0]);
  const isOk = confirm("Are you sure want to update user");
  if (!isOk) {
    return;
  }

  const response = await fetch("../controller/update.php", {
    method: "POST",
    body: formData,
  });

  const result = await response.json();
  console.log(result);
  alert(result.message);
  if (result.status === "success") {
    console.log("redirecting");
    window.location.href = "../view/view.php";
  }
};
document.getElementById("form").addEventListener("submit", updateUserFrom);
