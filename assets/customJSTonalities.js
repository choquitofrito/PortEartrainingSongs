$(".input-tonality-save").on("click", function () {
  $.ajax({
    type: "POST",
    url: "/song/study/status/save",
    data: {
      tonality: $(this).data("tonality"),
      idSong: $(this).data("id-song"),
      tempoVal: $(this).prev().val(),
    },
    success: function (data) {
      console.log(data);
    },
  });
});
