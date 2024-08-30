const updateUser=(id)=>{
    console.log("update", id);
    window.location.href="../view/update.php?q="+id;
}

const fetchUsers= async()=>{
    try {
        const response= await fetch('../controller/getusers.php',{
            method:"GET",
        });
        const result = await response.json();
        console.log(result);
        result?.data.forEach(element => {
            console.log(element)
            const newdiv= document.createElement('tr');
                     
            newdiv.innerHTML=`
            <td> ${element.userId} </td> 
            <td> ${element.name} </td> 
            <td> ${element.email} </td> 
            <td> ${element.address} </td> 
            <td> ${element.contact} </td> 
            <td> ${element.userImage ? `<img src="../controller/${element.userImage}" style="height:70px;">` : "No image"} </td>

            <td onclick="updateUser(${element.userId})" id="edit"> Edit </td>
            <td onclick="deleteUser(${element.userId})" id="delete"> Delete</td> 
            `;
            document.getElementById('table').appendChild(newdiv);
        });
    } catch (error) {
        console.log(error);
    }
}

const deleteUser=async(id)=>{
    console.log("del", id);
    const isOk= confirm("Are you sure want to delete this user?")
    if(!isOk){
        return;
    }
    try {
        const response= await fetch(`../controller/delete.php?q=${id}`,{
            method:"GET",
        });
        const result = await response.text();
        console.log(result);
        if(result){
            alert("user deleted!!");
            window.location.reload();
        }

    } catch (error) {
        console.log(error);
    }
}
fetchUsers();