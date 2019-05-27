<?php
    /*
     * Lydian Lion Academy - Listado de videos
     * 
     *
     <iframe src="https://player.vimeo.com/video/327467646" width="640" height="347" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
     *
     */
    $videos = array( 

    	'046' => array('url' => 'https://player.vimeo.com/video/321094046',
    					'titulo' => 'Bienvenida', 
    					'tema' => 'Bienvenida',
                        'desc' => '¡Bienvenidos a Lydian Lion Academy!'),

    	'339' => array('url' => 'https://player.vimeo.com/video/322914339',
    					'titulo' => 'Configurando tu TradingView',
    					'tema' => 'Antes de comenzar a operar',
                        'desc' => 'Debemos conocer las herramientas que necesitamos antes de empezar a realizar nuestras primeras operaciones. Todas las herramientas indispensables para realizar análisis técnico se encuentran en la plataforma de TradingView.'),

        '134' => array('url' => 'https://player.vimeo.com/video/321097134',
                        'titulo' => 'MT4',
                        'tema' => 'Antes de comenzar a operar',
                        'desc' => 'MetaTrader 4 es la herramienta ideal para iniciar o retirar nuestras operaciones del mercado.'),

        '193' => array('url' => 'https://player.vimeo.com/video/321096193',
                        'titulo' => 'Brokers, cuenta de margen y apalancamiento',
                        'tema' => 'Antes de comenzar a operar',
                        'desc' => 'Debemos verificar todas las opciones antes de decidir cual es el bróker que queremos para que nos acompañe en nuestras operaciones.'),

        '518' => array('url' => 'https://player.vimeo.com/video/322079518',
                        'titulo' => 'Tipos de órdenes',
                        'tema' => 'Antes de comenzar a operar',
                        'desc' => 'Las órdenes te permitirán darte un respiro del gráfico y confiar en tu análisis.'),

        '820' => array('url' => 'https://player.vimeo.com/video/321096820',
                        'titulo' => 'Consejos útiles',
                        'tema' => 'Mentalidad del éxito',
                        'desc' => 'Debes tener en cuenta estos consejos si quieres tener disciplina en tu estrategia de trading.'),

        '128' => array('url' => 'https://player.vimeo.com/video/321095128',
                        'titulo' => 'Verlo todo color de rosa',
                        'tema' => 'Mentalidad del éxito',
                        'desc' => 'La actitud es lo más importante a la hora de hacer trading, siempre debes ser positivo sin importar cuales sean las situaciones que te presente el mercado.'),

        '296' => array('url' => 'https://player.vimeo.com/video/325317296',
                        'titulo' => 'No ames ni odies al mercado',
                        'tema' => 'Mentalidad del éxito',
                        'desc' => 'La venganza nunca es buena mata el alma y la envenena, con este refrán solo queremos que aprendas que no debemos ser emocionales con decisiones que tomamos al iniciar nuestras operaciones. Que un movimiento del mercado no haya tenido lugar como predecimos y disminuya nuestra cuenta de margen no es un motivo para iniciar más operaciones tratando de recuperar desesperadamente lo perdido.'),

        '577' => array('url' => 'https://player.vimeo.com/video/321097577',
                        'titulo' => 'Encuentra tu estilo de trading',
                        'tema' => 'Mentalidad del éxito',
                        'desc' => 'Cada quien crea su estrategia de trading dependiendo de cómo analice el mercado, por eso no trates de imitar a los demás.'),

        '162' => array('url' => 'https://player.vimeo.com/video/322914162',
                        'titulo' => 'Introducción al manejo del riesgo',
                        'tema' => 'Manejo del riesgo',
                        'desc' => 'El manejo del riesgo es nuestro aliado principal para controlar nuestras emociones y actuar objetivamente. Así lograremos limitar y precisar todas nuestras proyecciones en el mercado.'),

        '100' => array('url' => 'https://player.vimeo.com/video/325525100',
                        'titulo' => 'Estrategia de trading',
                        'tema' => 'Manejo del riesgo',
                        'desc' => 'Las formaciones nos permiten apreciar en la acción del precio posiciones de este que podrían indicar un movimiento o pronosticar una posible dirección del precio.'),

        '397' => array('url' => 'https://player.vimeo.com/video/322080397',
                        'titulo' => 'Tipos de gráficos',
                        'tema' => 'Fundamentos del gráfico',
                        'desc' => 'En los distintos tipos de gráfico podemos ver claramente algunos movimientos del precio, usarlos a nuestro favor es lo que buscamos.'),

        '238' => array('url' => 'https://player.vimeo.com/video/321099238',
                        'titulo' => 'Timeframes',
                        'tema' => 'Fundamentos del gráfico',
                        'desc' => 'Los timeframes o temporalidades nos permiten apreciar los movimientos del precio históricamente, desde mensual hasta cada minuto, así estudiando el movimiento del precio podemos entender hacia donde podría variar éste.'),

        '838' => array('url' => 'https://player.vimeo.com/video/325276838',
                        'titulo' => 'Niveles clave: El ingrediente secreto',
                        'tema' => 'Fundamentos del gráfico',
                        'desc' => 'Los niveles clave son puntos de resistencia fuerte, los mismos nos permiten predecir hacia donde existiría un posible movimiento del precio.'),

        '873' => array('url' => 'https://player.vimeo.com/video/326104873',
                        'titulo' => 'Soportes y Resistencias',
                        'tema' => 'Fundamentos del gráfico',
                        'desc' => 'Hay lugares de resistencia fuerte que al movimiento del precio se le hace difícil romper.'),

        '800' => array('url' => 'https://player.vimeo.com/video/322914080',
                        'titulo' => 'Introducción a Acción del Precio',
                        'tema' => 'Acción del precio',
                        'desc' => 'Las formaciones nos permiten apreciar en la acción del precio posiciones de este que podrían indicar un movimiento o pronosticar una posible dirección del precio.'),

        '308' => array('url' => 'https://player.vimeo.com/video/321098308',
                        'titulo' => 'El arte de las velas japonesas',
                        'tema' => 'Acción del precio',
                        'desc' => 'Las formaciones nos permiten apreciar en la acción del precio posiciones de este que podrían indicar un movimiento o pronosticar una posible dirección del precio.'),

        '230' => array('url' => 'https://player.vimeo.com/video/322082230',
                        'titulo' => 'Patrones de movimiento de velas',
                        'tema' => 'Acción del precio',
                        'desc' => 'Los patrones son formaciones que con el tiempo aprenderás a identificar en el gráfico, los mismos ofrecen una herramienta más en el análisis de la acción del precio.'),

        '160' => array('url' => 'https://player.vimeo.com/video/327123160',
                        'titulo' => 'Introducción a Fibonacci',
                        'tema' => 'Fibonacci',
                        'desc' => 'Para verificar un patrón de la acción del precio debe de formarse éste con retrocesos válidos.'),

        '646' => array('url' => 'https://player.vimeo.com/video/327467646',
                        'titulo' => 'Fibonacci - Retrocesos válidos',
                        'tema' => 'Fibonacci',
                        'desc' => 'Para verificar un patrón de la acción del precio debe de formarse éste con retrocesos válidos.'),

	);
	/* --------------------------------------------------------- */
?>