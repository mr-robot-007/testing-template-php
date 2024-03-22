var xhr = new XMLHttpRequest();
var data = [];
const x = [];
xhr.open("GET", "fetchusers.php", true);
xhr.onload = function () {
  if (xhr.status === 200) {
    data = JSON.parse(xhr.responseText);
    console.log(data); // Use your fetched data here

    for (let i = 1; i <= 7; i++) {
      const curr_date = `2024-03-0${i}`;
      let numOfUsers = 0;
      // console.log(data[0].created_at);
      data.map((item) => {
        if (item.created_at == curr_date) {
          numOfUsers++;
        }
      });

      const y = {
        date: `0${i}-03-2024`,
        count: numOfUsers,
      };
      x.push(y);
    }
    console.log(x);
    new Chart(document.getElementById("chart"), {
      type: "bar",
      data: {
        labels: x.map((row) => row.date),
        datasets: [
          {
            label: "Number of users signed up",
            data: x.map((row) => row.count),
          },
        ],
      },
    });
  } else {
    console.log("Request failed. Status: " + xhr.status);
  }
};
xhr.send();
