let formData;

const submitFormData = async (e) => {
    
    e.preventDefault();
    formData = new FormData(e.target);
    const fileInput = document.getElementById('userImage');
    formData.append('file', fileInput.files[0]);
    const isOk= confirm("Are you sure want to add user");
    if(!isOk){
        return;
    }

    const response = await fetch('../controller/register.php', {
        method: "POST",
        body: formData
    });

    const result = await response.json();
    console.log(result);
    alert(result.message);
    if(result.status==="success"){
        console.log("redirecting")
        window.location.href = "../view/view.php";
    }
}


document.getElementById("form").addEventListener('submit', submitFormData);
