const fetchLogs=async ()=>{
    try {
        const response= await fetch('../controller/getlogs.php',{
            method:"GET",
        });
        const result = await response.json();
        console.log(result);
        
        result?.data.forEach( (element, i) => {
            const newtag= document.createElement('tr');
            // newtag.className="log";
            // const preVal= await JSON.parse(element.prev_values)
            // const curVal= await JSON.parse(element.curr_values)
            // console.log(preVal, curVal);
            // console.log(element.infotext, element.updatedAt)
            newtag.innerHTML=`
            <td> ${i+1} </td>
            <td> ${element.infotext} </td> 
            <td> ${element.updatedAt} </td> 
            <td  id='viewUpdate'> <button onclick="viewUpdate(${element.historyId})">View Updates</button> </td> 
            `;
            document.getElementById('table').appendChild(newtag);

        });
        


    } catch (error) {
        console.log(error);
    }
}

const viewUpdate=(id)=>{
    console.log(id);
    window.location.href="../view/logview.php?q="+id;
}


fetchLogs();