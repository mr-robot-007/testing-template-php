var xhr = new XMLHttpRequest();
xhr.open("GET", "fetchtodos.php", true);
xhr.onload = function () {
  if (xhr.status === 200) {
    var data = JSON.parse(xhr.responseText);
    console.log(data); // Use your fetched data here
    $("#example").DataTable({
      columns: [
        { title: "ID", data: "id" },
        { title: "Title", data: "title" },
        { title: "Description", data: "description" },
        { title: "Assigned_to", data: "assigned_to" },
        { title: "Status", data: "status" },
      ],
      data: data,
    });
  } else {
    console.log("Request failed. Status: " + xhr.status);
  }
};
xhr.send();
