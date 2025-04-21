function Pagination() {
  $("#pagination").twbsPagination({
    totalPages: <?php echo $total_pages; ?>,
    visible: 5,
    onPageClick: function (e, page) {
      e.preventDefault();
      $("#target-content").html("loading....");
      $("#target-content").load("jobpagination.php?page="+page);
    }
  });
}

$(function () {
  Pagination();
  // Add this line to load the first page of jobs on initial page load
  $("#target-content").load("jobpagination.php?page=1");
});

$("#searchBtn").on("click", function(e) {
  e.preventDefault();
  var searchResult = $("#searchBar").val();
  var filter = "searchBar";
  if(searchResult != "") {
    $("#pagination").twbsPagination('destroy');
    Search(searchResult, filter);
  } else {
    $("#pagination").twbsPagination('destroy');
    Pagination();
  }
});

$(".experienceSearch").on("click", function(e) {
  e.preventDefault();
  var searchResult = $(this).data("target");
  var filter = "experience";
  if(searchResult != "") {
    $("#pagination").twbsPagination('destroy');
    Search(searchResult, filter);
  } else {
    $("#pagination").twbsPagination('destroy');
    Pagination();
  }
});

$(".citySearch").on("click", function(e) {
  e.preventDefault();
  var searchResult = $(this).data("target");
  var filter = "city";
  if(searchResult != "") {
    $("#pagination").twbsPagination('destroy');
    Search(searchResult, filter);
  } else {
    $("#pagination").twbsPagination('destroy');
    Pagination();
  }
});

function Search(val, filter) {
  $("#pagination").twbsPagination({
    totalPages: <?php echo $total_pages; ?>,
    visible: 5,
    onPageClick: function (e, page) {
      e.preventDefault();
      val = encodeURIComponent(val);
      $("#target-content").html("loading....");
      $("#target-content").load("search.php?page="+page+"&search="+val+"&filter="+filter);
    }
  });
  
  // Also load first page of search results immediately
  val = encodeURIComponent(val);
  $("#target-content").html("loading....");
  $("#target-content").load("search.php?page=1&search="+val+"&filter="+filter);
}
