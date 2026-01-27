var id = document.getElementById("id");
var namee = document.getElementById("name");
var email = document.getElementById("email");
var age = document.getElementById("age");
var gender = document.getElementById("gender");

/* Load Users */
function loadUsers() {
  fetch("list.php")
    .then(res => res.text())
    .then(data => {
      document.getElementById("userTable").innerHTML = data;
    })
    .catch(err => console.error(err));
}
loadUsers();

/* Add / Update User */
function saveUser() {
  if (
    namee.value.trim() === "" ||
    email.value.trim() === "" ||
    age.value.trim() === "" ||
    gender.value === ""
  ) {
    alert("All fields are required");
    return;
  }

  var data = new FormData();
  data.append("id", id.value.trim());
  data.append("name", namee.value.trim());
  data.append("email", email.value.trim());
  data.append("age", age.value.trim());
  data.append("gender", gender.value);

  var isEdit = id.value.trim() !== "";
  var url = isEdit ? "ajax/edit.php" : "ajax/submit.php";

  fetch(url, {
    method: "POST",
    body: data
  })
    .then(res => res.text())
    .then(response => {
      alert(response);
      if (response.toLowerCase().includes("successfully")) {
        clearForm();
        loadUsers();
      }
    })
    .catch(err => console.error(err));
}

/* Edit User */
function editUser(uid, uname, uemail, uage, ugender) {
  id.value = uid;
  namee.value = uname;
  email.value = uemail;
  age.value = uage;
  gender.value = ugender;
}

/* Delete User */
function deleteUser(uid) {
  if (!confirm("Delete user?")) return;

  var data = new FormData();
  data.append("id", uid);

  fetch("ajax/delete.php", {
    method: "POST",
    body: data
  })
    .then(res => res.text())
    .then(() => {
      loadUsers();
    })
    .catch(err => console.error(err));
}

/* Clear Form */
function clearForm() {
  id.value = "";
  namee.value = "";
  email.value = "";
  age.value = "";
  gender.value = "";
}
