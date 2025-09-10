<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="theme-color" content="#d58c00">  
        <link rel="icon" type="image/png" sizes="192x192" href="https://raspa.bggames.site/storage/uploads/pbP7W9bKZmZBKOJjH57iaqG538RiKUzTBjueUzVe.png">
      
      <!-- Meta Tags Essenciais -->
        <title>RaspouGanhou - A raspadinha número 1 do Brasil</title>
        <meta name="description" content="Jogue na CorujaBET e descubra o melhor cassino online ao vivo! Aposte em esportes e cassino com bônus exclusivos. Depósitos rápidos via Pix.">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="RaspouGanhou - A raspadinha número 1 do Brasil">
        <meta property="og:description" content="Raspe na RaspouGanhou! A raspadinha número 1 do Brasil. Depósitos via Pix e saques instantâneos.">
        <meta property="og:image" content="https://raspa.bggames.site/storage/uploads/pbP7W9bKZmZBKOJjH57iaqG538RiKUzTBjueUzVe.png">
        <meta property="og:url" content="https://corujabet.site">
        <meta property="og:site_name" content="Coruja BET">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="RaspouGanhou - A raspadinha número 1 do Brasil">
        <meta name="twitter:description" content="Entre no mundo das apostas com CorujaBET! Cassino ao vivo, jogos exclusivos e bônus especiais para novos jogadores.">
        <meta name="twitter:image" content="https://raspa.bggames.site/storage/uploads/pbP7W9bKZmZBKOJjH57iaqG538RiKUzTBjueUzVe.png">

        <!-- SEO Keywords -->
        <meta name="keywords" content="Cassino online, apostas esportivas, jogos de azar, slots, roleta, blackjack, poker, cassino ao vivo, bônus cassino, CorujaBET, apostas com Pix">

        <!-- Robots (Indexação) -->
        <meta name="robots" content="noindex, nofollow">

        <!-- Canonical -->
        <link rel="canonical" href="https://corujabet.site">

        <?php $setting = \Helper::getSetting() ?>
        <?php if(!empty($setting['software_favicon'])): ?>
            <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('/storage/' . $setting['software_favicon'])); ?>">
        <?php endif; ?>

        <link rel="stylesheet" href="<?php echo e(asset('assets/css/fontawesome.min.css')); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100&display=swap" rel="stylesheet">        
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="manifest" href="/manifest.json">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


        <title><?php echo e(env('APP_NAME')); ?></title>
        
        <!-- Código Base do Pixel do Facebook -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;
          n.push=n;
          n.loaded=!0;
          n.version='2.0';
          n.queue=[];
          t=b.createElement(e);
          t.async=!0;
          t.src=v;
          s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}
          (window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          
          fbq('init', "<?php echo e(env('FB_ID')); ?>"); // Substitua pelo seu ID do Pixel
          fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=<?php echo e(env('FB_ID')); ?>&ev=PageView&noscript=1"
        /></noscript>


        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <?php $custom = \Helper::getCustom() ?>
        <style>
            body{
                /* font-family: "'Roboto', sans-serif"; */
                font-family: "Montserrat", sans-serif;
            }
            :root {
                --ci-primary-color: <?php echo e($custom['primary_color']); ?>;
                --ci-primary-opacity-color: <?php echo e($custom['primary_opacity_color']); ?>;
                --ci-secundary-color: <?php echo e($custom['secundary_color']); ?>;
                --ci-gray-dark: <?php echo e($custom['gray_dark_color']); ?>;
                --ci-gray-light: <?php echo e($custom['gray_light_color']); ?>;
                --ci-gray-medium: <?php echo e($custom['gray_medium_color']); ?>;
                --ci-gray-over: <?php echo e($custom['gray_over_color']); ?>;
                --title-color: <?php echo e($custom['title_color']); ?>;
                --text-color: <?php echo e($custom['text_color']); ?>;
                --sub-text-color: <?php echo e($custom['sub_text_color']); ?>;
                --placeholder-color: <?php echo e($custom['placeholder_color']); ?>;
                --background-color: <?php echo e($custom['background_color']); ?>;
                --standard-color: #1C1E22;
                --shadow-color: #111415;
                --page-shadow: linear-gradient(to right, #111415, rgba(17, 20, 21, 0));
                --autofill-color: #f5f6f7;
                --yellow-color: #FFBF39;
                --yellow-dark-color: #d7a026;
                --border-radius: <?php echo e($custom['border_radius']); ?>;
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-scroll-snap-strictness: proximity;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgba(59,130,246,.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;

                --input-primary: <?php echo e($custom['input_primary']); ?>;
                --input-primary-dark: <?php echo e($custom['input_primary_dark']); ?>;

                --carousel-banners: <?php echo e($custom['carousel_banners']); ?>;
                --carousel-banners-dark: <?php echo e($custom['carousel_banners_dark']); ?>;


                --sidebar-color: <?php echo e($custom['sidebar_color']); ?> !important;
                --sidebar-color-dark: <?php echo e($custom['sidebar_color_dark']); ?> !important;


                --navtop-color <?php echo e($custom['navtop_color']); ?>;
                --navtop-color-dark: <?php echo e($custom['navtop_color_dark']); ?>;


                --side-menu <?php echo e($custom['side_menu']); ?>;
                --side-menu-dark: <?php echo e($custom['side_menu_dark']); ?>;

                --footer-color <?php echo e($custom['footer_color']); ?>;
                --footer-color-dark: <?php echo e($custom['footer_color_dark']); ?>;

                --card-color <?php echo e($custom['card_color']); ?>;
                --card-color-dark: <?php echo e($custom['card_color_dark']); ?>;
            }
            .navtop-color{
                background-color: <?php echo e($custom['sidebar_color']); ?> !important;
            }
            :is(.dark .navtop-color) {
                background-color: <?php echo e($custom['sidebar_color_dark']); ?> !important;
            }

            .bg-base {
                background-color: <?php echo e($custom['background_base']); ?>;
            }
            :is(.dark .bg-base) {
                background-color: <?php echo e($custom['background_base_dark']); ?>;
            }
            /* Oculta a scrollbar em navegadores WebKit */
            ::-webkit-scrollbar {
              display: none !important;
            }
            
            /* Para garantir que o conteúdo ainda seja rolável */
            html, body {
              scrollbar-width: none !important; /* Firefox */
              -ms-overflow-style: none !important; /* Internet Explorer e Edge */
            }
        </style>

        <?php if(!empty($custom['custom_css'])): ?>
            <style>
                <?php echo $custom['custom_css']; ?>

            </style>
        <?php endif; ?>

        <?php if(!empty($custom['custom_header'])): ?>
            <?php echo $custom['custom_header']; ?>

        <?php endif; ?>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
      <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'pt',
      includedLanguages: 'en,es,fr,de,it',  // idiomas que quer oferecer
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script>
  window.OneSignalDeferred = window.OneSignalDeferred || [];
  OneSignalDeferred.push(async function(OneSignal) {
    await OneSignal.init({
      appId: "115d1f72-90d3-46d2-9e56-b3760f6b74c4",
    });
  });
</script>

    </head>
    <body color-theme="dark" class="bg-base text-gray-800 dark:text-gray-300 ">
        <div id="viperpro"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/datepicker.min.js"></script>
        <script>
            window.Livewire?.on('copiado', (texto) => {
                navigator.clipboard.writeText(texto).then(() => {
                    Livewire.emit('copiado');
                });
            });

            window._token = '<?php echo e(csrf_token()); ?>';
            window.custom = <?php echo json_encode($custom, 15, 512) ?>;
            //if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.remove('dark')
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light')
                document.documentElement.classList.add('dark')
            }
        </script>

        <?php if(!empty($custom['custom_js'])): ?>
            <script>
                <?php echo $custom['custom_js']; ?>

            </script>
        <?php endif; ?>

        <?php if(!empty($custom['custom_body'])): ?>
            <?php echo $custom['custom_body']; ?>

        <?php endif; ?>

        <?php if(!empty($custom)): ?>
            <script>
                const custom = <?php echo json_encode($custom); ?>;
            </script>
        <?php endif; ?>
     
      
      <script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
      .then(function(registration) {
        console.log('Service Worker registrado com sucesso:', registration.scope);
      })
      .catch(function(error) {
        console.log('Falha no registro do Service Worker:', error);
      });
  }
</script>

    </body>
</html>
<?php /**PATH D:\WindSurfProjects\raspadinha_29do7\resources\views\layouts\app.blade.php ENDPATH**/ ?>