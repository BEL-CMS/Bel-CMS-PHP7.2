(function($) {
	var $imageSlides = $('.image-slide'),
		$imageBox = $('.post-image .product-preview-image'),
		$slideCtrlLeft = $('.post-image').parent().find('.slide-control.left'),
		$slideCtrlRight = $('.post-image').parent().find('.slide-control.right'),
		slideCount = $('.image-slides').attr('data-slide-count'),
		visibleSlidesFull = $('.image-slides').attr('data-slide-visible-full') - 1,
		visibleSlidesSmall = $('.image-slides').attr('data-slide-visible-small') - 1,
		docWidth = $(document).width(),
		currentSlide = 0,
		leftLimit = 0,
		breakpoint = 918,
		visibleSlides = ( docWidth <= breakpoint ) ? visibleSlidesSmall : visibleSlidesFull,
		rightLimit = visibleSlides,
		currentOffset = 0,
		offset = 106;

	$slideCtrlLeft.on( 'click', prevSlide );
	$slideCtrlRight.on( 'click', nextSlide );

	function initSlides() {
		var index = 0,
			leftOffset = 0;
		$imageSlides.each( function() {
			var $this = $(this);
			$this.css({
				'left': leftOffset
			});
			$this.attr( 'data-index', index );
			$this.on( 'click', { index: index }, preSelectImage );
			index++;
			leftOffset += offset;
		});
	}

	function preSelectImage( e ) {
		selectImage( e.data.index );
	}

	function selectImage( index ) {
		var $this = $imageSlides.eq( index ),
			src = $this.find('.product-preview-image img').attr('src');

		if ( $this.hasClass( 'selected' ) ) return;

		currentSlide = index;
		currentOffset = leftLimit * offset;
		$('.image-slides').css({
			'left': -currentOffset
		});

		unselectImages();
		$this.addClass( 'selected' );
		loadImage( src );
	}

	function unselectImages() {
		$imageSlides.each( function() {
			var $this = $(this);

			if ( $this.hasClass( 'selected' ) ) {
				$this.removeClass( 'selected' );
			}
		});
	}

	function loadImage( src ) {
		$imageBox.children( 'img' ).attr( 'src', src );
		$imageBox.imgLiquid();
	}

	function prevSlide() {
		var index = ( currentSlide === 0 ) ? slideCount - 1 : currentSlide - 1;

		if ( index < leftLimit ) {
			rightLimit--;
			leftLimit--;
		}

		if( index === ( slideCount - 1 ) ) {
			leftLimit = slideCount - 1 - visibleSlides;
			rightLimit = slideCount - 1;
		}

		selectImage( index );
	}

	function nextSlide() {
		var index = ( currentSlide === ( slideCount - 1 ) ) ? 0 : currentSlide + 1;

		if ( index > rightLimit ) {
			rightLimit++;
			leftLimit++;
		}

		if( index === 0 ) {
			leftLimit = 0;
			rightLimit = visibleSlides;
		}

		selectImage( index );
	}

	initSlides();

})(jQuery);