<script>
function viewStrLen(){
  var len = document.getElementById("tweetArea").value.length;
  document.getElementById("strLen").innerText = len + "/140文字";
}
</script>

<!-- ツイートフォーム -->
<section class="tweetFrom">
  <form action="/postTweet" method="post">
  {{ csrf_field() }}
  <textarea class ="tweetArea" name ="tweetArea" id="tweetArea"
  placeholder="What are you doing?" onkeyup="viewStrLen();"
  maxlength="140"></textarea>

  <div class="text-right"><div id="strLen">0/140文字</div><input type="submit" class="btn btn-primary" value="ツイート"></div>
  </form>
</section>
