const url = new URL(window.location.href);

const params = new URLSearchParams(url.search);

const q = params.get('q');

console.log(q);

const fetchlog=async()=>{
    try {
        const response= await fetch(`../controller/getlog.php?q=${q}`,{
            method:"GET"
        });

        const data= await response.json();
        console.log(data);
        const prev=await JSON.parse(data.data.prev_values);
        const curr= await JSON.parse(data.data.curr_values);
        document.getElementById('info').innerText= data.data.infotext;
        console.log(prev, curr);
        const temp= prev ? prev : curr;
        Object.keys(temp).forEach(ele=>{
            const tr= document.createElement('tr');
            const prevShow= prev? prev[ele] : "New Created";
            const currShow= curr? curr[ele] : "Deleted";
            tr.innerHTML=`
                <td> ${ele}</td>
                <td class='${prevShow.toString()===currShow.toString() ? "" : "danger"}'> ${prevShow}</td>
                <td class='${prevShow.toString()===currShow.toString() ? "" : "success"}'> ${currShow}</td>
            `;
            document.getElementById('table').appendChild(tr);
            
        })
    } catch (error) {
        console.log(error);
    }
}
fetchlog();