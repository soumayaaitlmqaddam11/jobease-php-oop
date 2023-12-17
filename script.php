function filterjob() {
  let title = document.getElementById("title").value;
  let results = document.getElementById("results");
  $.ajax({
    method: "POST",
    url: "search.php",
    data: {
      title: title,
    },
    // dataType: "json",

    success: function (response) {
      //   console.log("the response is :", response);
      results.innerHTML = response;
    },
    error: function () {
      alert("it doesn't work");
    },
  });
}
function findjob(id) {
  let title = document.getElementById("title").value;
  let results = document.getElementById("results");
  $.ajax({
    method: "POST",
    url: "findjob.php",
    data: {
      id: id,
    },
    // dataType: "json",

    success: function (response) {
      //   console.log("the response is :", response);
      results.innerHTML = response;
    },
    error: function () {
      alert("it doesn't work");
    },
  });
}
(function () {
  $.ajax({
    method: "GET",
    url: "search.php",
    data: {},
    // dataType: "json",

    success: function (response) {
      //   console.log("the response is :", response);
      results.innerHTML = response;
    },
    error: function () {
      alert("it doesn't work");
    },
  });
})();
