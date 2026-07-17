// LocalStorage থেকে votes আনা
let votes = JSON.parse(localStorage.getItem("votes")) || {};

const voteList = document.getElementById("vote-list");
const message = document.getElementById("message");
const resultBtn = document.getElementById("result_btn");
const backBtn = document.getElementById("back-btn");

message.innerText = "Vote Count Result:";

// Result button click করলে দেখাবে
resultBtn.addEventListener("click", function () {

  voteList.innerHTML = "";

  if (Object.keys(votes).length === 0) {
    message.innerText = "No vote has been cast yet!";
    return;
  }

  for (let party in votes) {
    let li = document.createElement("li");
    li.textContent = party + " : " + votes[party] + " vote";
    voteList.appendChild(li);
  }
});

// Back button
backBtn.addEventListener("click", function () {
  window.location.href = "vot.html";
});