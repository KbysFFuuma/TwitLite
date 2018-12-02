<!-- ツイートフォーム -->
<section class="tweetFrom">
  <form action="/postTweet" method="post">
  {{ csrf_field() }}
  <textarea class ="tweetArea" name="tweetArea" cols="20" rows="10"
  placeholder="What are you doing?"></textarea>
  <div class="text-right"><input type="submit" class="btn btn-primary" value="ツイート"></div>
  </form>
</section>
