<?php

namespace MediaWiki\Extension\Piwigo\Tests;

use MediaWiki\Extension\Piwigo\Hooks;
use MediaWiki\Parser\Parser;

/**
 * @coversDefaultClass \MediaWiki\Extension\Piwigo\Hooks
 */
class HooksTest extends \MediaWikiUnitTestCase {

	/**
	 * @covers ::onParserFirstCallInit
	 */
	public function testOnParserFirstCallInit() {
		$parserMock = $this->getMockBuilder( Parser::class )
			->disableOriginalConstructor()
			->getMock();

		$parserMock->expects( $this->once() )
			->method( 'setHook' )
			->with( 'piwigo', [ Hooks::class, 'parserKeywordPiwigo' ] );

		$parserMock->expects( $this->once() )
			->method( 'setFunctionHook' )
			->with( 'piwigo', [ Hooks::class, 'parserFunctionPiwigo' ] );

		$hooks = new Hooks();
		$result = $hooks->onParserFirstCallInit( $parserMock );

		$this->assertTrue( $result );
	}
}
