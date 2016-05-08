<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ URL::asset('css/materialize.min.css') }}" rel="stylesheet" />
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>
            {{ $viewModel->titleTag }}
        </title>

        <link id="twentytwelve-fonts-css"
              rel="stylesheet"
              href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700&amp;subset=latin,latin-ext"
              type="text/css" media="all">

        <link id="twentytwelve-style-css"
              rel="stylesheet"
              href="http://www.pendulumphotography.ca/wp-content/themes/twentytwelve/style.css?ver=4.2-beta1-31803"
              type="text/css" media="all">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>

        <style type="text/css" id="custom-background-css">
            body.custom-background {
                background-color: #fcfcfc;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".dropdown-button").dropdown();

                // This is the dropdown for mobile css mode.
                $(".dropdown-mobile-button").dropdown({
                    constrain_width: false, // Does not change width of dropdown to that of the activator
                    gutter: 0, // Spacing from edge
                    belowOrigin: false, // Displays dropdown below the button
                    alignment: 'left' // Displays dropdown with edge aligned to the left of button
                  }
                );

                // Initialize collapse button
                $(".button-collapse").sideNav({
                    menuWidth: 280, // Default is 240
                    edge: 'left' // Choose the horizontal origin
                  }
                );

                // This should open up a modal.
                $('.contact-trigger').leanModal({
                      dismissible: true, // Modal can be dismissed by clicking outside of the modal
                      opacity: .5 // Opacity of modal background
                  }
                );

                $('#sendEmail').click(function() {
                    var submitData = {}
                    var contactFormAction = $('form#formContact').attr('action');
                    $('form#formContact :input').each(function(index, value) {
                        var emailInput = $(this),
                            name = emailInput.attr('name'),
                            value = emailInput.val();

                        submitData[name] = value;
                    });
                    $.post($('form.contact-form').attr('action'), submitData);
                })
                // Initialize collapsible (uncomment the line below if you use the dropdown variation)
                //$('.collapsible').collapsible();
            });
        </script>
    </head>
    <?php
    ?>
    <body class="home blog custom-background full-width custom-font-enabled single-author">
          <!-- Contact Modal Structure -->
        <div id="contact-modal" class="modal modal-fixed-footer custom-contact-modal">
            <div class="modal-content">
                <div class="contact-content">
                  <?php
                      print_r($contactContent);
                  ?>
                </div>
                <div class="row">
                    {!! Form::open(array('route' => 'contact.email', 'class'=> "contact-form col s12", 'id' => "formContact")) !!}
                      <div class="row">
                        <div class="input-field col s6">
                          <input id="senders_name" type="text" name="sender" class="validate">
                          <label for="senders_name">Your Name</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <input id="email" type="email" name="email" class="validate">
                          <label for="email">Your Email</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <input id="subject" type="text" name="subject" class="validate">
                          <label for="subject">Subject</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <textarea id="contact-message" name="message-body" class="materialize-textarea"></textarea>
                          <label for="contact-message">Your Message</label>
                        </div>
                      </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
              <a class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</a>
              <a class=" modal-action modal-close waves-effect waves-green btn-flat"  id="sendEmail">Send</a>
            </div>
        </div>
        <ul id="galleryDropDown" class="dropdown-content">
          <?php
            foreach($menuItems as $result) {
              echo '<li><a href="'.URL::route('portfolio-gallery', $result->ID).'">';
              echo strtoupper($result->post_title);
              echo '</a></li>';
            }
          ?>
        </ul>
        <nav class="blue-grey" role="navigation">
            <div class="nav-wrapper">
                <a href="#" data-activates="nav-mobile" class="button-collapse">
                    <i class="material-icons" style="margin-left:5px">menu</i>
                </a>
                <span title="pendulum | photography" rel="home" class="brand-logo">&nbsp{{ $viewModel->navBarLabel}}
                </span>
                <ul class="right hide-on-med-and-down">
                    <li class="<?php if (isset($navBarActive['home'])) {
                      echo 'active';
                    }?>">
                        <a href="{{ URL::route('home') }}">
                            Home
                        </a>
                    </li>
                    <!-- Dropdown Trigger -->
                    <li class="dropdown <?php if (isset($navBarActive['portfolio'])) {
                        echo 'active';
                    }?>">
                        <a class="dropdown-button" href="#!" data-activates="galleryDropDown">Portfolio
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    <li class="<?php if (isset($navBarActive['about'])) {
                        echo 'active';
                    }?>">
                        <a href="{{ URL::route('about') }}">
                            About
                        </a>
                    </li>
                    <li class="<?php if (isset($navBarActive['contact'])) {
                        echo 'active';
                    }?>">
                        <a class='contact-trigger' href="#contact-modal">
                            Contact
                        </a>
                    </li>
                </ul>
                <!-- Mobile Nav Bar (Can have different options than default nav bar.-->
                <ul class="side-nav" id="nav-mobile">
                    <li class="<?php if (isset($navBarActive['home'])) {
                      echo 'active';
                    }?>">
                        <a href="{{ URL::route('home') }}">
                            Home
                        </a>
                    </li>
                    <!-- Dropdown Trigger -->
                    <li class="dropdown <?php if (isset($navBarActive['portfolio'])) {
                        echo 'active';
                    }?>">
                        <a class="dropdown-mobile-button" href="#!" data-activates="2ndGalleryDropDown">Portfolio
                            <b class="caret"></b>
                        </a>
                    </li>
                    <li class="<?php if (isset($navBarActive['about'])) {
                        echo 'active';
                    }?>">
                        <a href="{{ URL::route('about') }}">
                            About
                        </a>
                    </li>
                    <li class="<?php if (isset($navBarActive['contact'])) {
                        echo 'active';
                    }?>">
                        <a class='contact-trigger' href="#contact-modal">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    @yield('content')
</body>

</html>