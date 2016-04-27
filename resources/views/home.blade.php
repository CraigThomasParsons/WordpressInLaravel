@extends('layouts.main')

@section('content')
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <div class="section no-pad-bot" id="index-banner">
  <div class="container">
  <br><br>
  <div class="row center">
    <h2>capture. preserve. treasure.</h2>
  </div>
    <div class="entry-content">
      <?php
          foreach ($posts as $post) {
            echo '<p class="home-page-paragraph">'.$post->post_content.'</p>';
          }
      ?>
    </div>
      <br><br>

    </div>
  </div>
@stop