const resultList = document.getElementById("result-list");

// localStorage থেকে votes আনা
let votes = JSON.parse(localStorage.getItem("votes")) || {};

// যদি কোনো vote না থাকে
if(Object.keys(votes).length === 0){
    const li = document.createElement("li");
    li.textContent = "No votes yet";
    resultList.appendChild(li);
}else{
    for(let candidate in votes){
        const li = document.createElement("li");
        li.innerHTML = `
            <span>${candidate.replace(/_/g," ")}</span>
            <span>${votes[candidate]}</span>
        `;
        resultList.appendChild(li);
    }
}

function goBack(){
    window.location.href = "vot.html";
}
