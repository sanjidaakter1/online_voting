// vot.js

const voteButton = document.querySelector("button");

voteButton.addEventListener("click", function(e){
    e.preventDefault(); // form submit বন্ধ

    const selected = document.querySelector('input[name="vote"]:checked');

    if(!selected){
        alert("Please select a candidate first!");
        return;
    }

    const candidate = selected.id;

    let votes = JSON.parse(localStorage.getItem("votes")) || {};

    votes[candidate] = (votes[candidate] || 0) + 1;

    localStorage.setItem("votes", JSON.stringify(votes));

    window.location.href = "view.html";
});