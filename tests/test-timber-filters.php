<?php

class TestTimberFilters extends Timber_UnitTestCase {
	function testRenderDataFilter() {
		add_filter('timber/loader/render_data', array($this, 'filter_timber_render_data'), 10, 2);
		$output = Timber::compile('assets/output.twig', array('output' => 14) );
		$this->assertEquals('output.twig assets/output.twig', $output);
	}

	function filter_timber_render_data($data, $file) {
		$data['output'] = $file;
		return $data;
	}

	function testOutputFilter() {
		add_filter('timber/output', array($this, 'filter_timber_output'), 10, 3);
		$output = Timber::compile('assets/single.twig', array('number' => 14) );
		$this->assertEquals('assets/single.twig14', $output);
	}

	function filter_timber_output( $output, $data, $file ) {
		return $file . $data['number'];
	}

	function testReadMoreLinkFilter() {
		$link = "Foobar";
		add_filter( 'timber/post/get_preview/read_more_link', array( $this, 'filter_timber_post_get_preview_read_more_link' ), 10, 1 );
		$this->assertEquals( 'Foobar', apply_filters( 'timber/post/get_preview/read_more_link', $link ) );
		remove_filter( 'timber/post/get_preview/read_more_link', array( $this, 'filter_timber_post_get_preview_read_more_link' ) );
	}

	function filter_timber_post_get_preview_read_more_link( $link ) {
		return $link;
	}

}
