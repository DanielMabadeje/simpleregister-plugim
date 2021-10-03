<?php

// wp_enqueue_script("finapp", plugin_dir_url(__FILE__) . 'assets/js/finapp-public.js', array('jquery'), '', false);

wp_enqueue_script("bootsrap", plugin_dir_url(__FILE__) . 'assets/js/lib/bootstrap.bundle.min.js', array('jquery'), '', false);

// wp_enqueue_script( "ionicons", plugin_dir_url( __FILE__ ) . 'https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js', array( 'jquery' ), $this->version, false );

wp_enqueue_script("splide", plugin_dir_url(__FILE__) . 'assets/js/plugins/splide/splide.min.js', array('jquery'), '', false);


// echo plugin_dir_url(__FILE__);
