<?php
use PHPUnit\Framework\TestCase;

class SplitArrayTest extends TestCase {

  
	public function dataTest() {
                return [
                    [
                        [
                            0 => ["Acrobat","Acrobat","Acrobat","Acrobat","Acrobat","Acrobat","Acrobat"],
                            1 => ["CS","CS","CS","CS","CS"],
                            2 => ["Captivate"],
                            3 => ["ColdFusion","ColdFusion","ColdFusion"],
                            4 => ["ColdBuilder"],
                            5 => ["Contribute","Contribute"],
                            6 => ["eLearning"],
                            7 => ["Director","Director","Director","Director","Director","Director","Director","Director"],
                            8 => ["Fireworks"],
                            9 => ["Flash","Flash","Flash","Flash","Flash"],
                            10 =>["FontFolio","FontFolio","FontFolio","FontFolio","FontFolio"],
                            11 =>["Freehand","Freehand","Freehand"],
                            12 =>["InDesign","InDesign"],
                            13 =>["Lightroom"],
                            14 =>["PageMaker","PageMaker","PageMaker","PageMaker","PageMaker"],
                            15 =>["Premiere","Premiere","Premiere","Premiere","Premiere"]
                        ],
                        [
                            [
                                0 => ["Acrobat","Acrobat","Acrobat","Acrobat","Acrobat","Acrobat","Acrobat"],
                                1 => ["CS","CS","CS","CS","CS"],
                                2 => ["Captivate"]
                            ],
                            [
                                3 => ["ColdFusion","ColdFusion","ColdFusion"],
                                4 => ["ColdBuilder"],
                                5 => ["Contribute","Contribute"],
                                6 => ["eLearning"],
                                7 => ["Director","Director","Director","Director","Director","Director","Director","Director"]
                            ],
                            [
                                8 => ["Fireworks"],
                                9 => ["Flash","Flash","Flash","Flash","Flash"],
                                10 => ["FontFolio","FontFolio","FontFolio","FontFolio","FontFolio"],
                                11 => ["Freehand","Freehand","Freehand"]
                            ],   
                            [
                                12 => ["InDesign","InDesign"],
                                13 => ["Lightroom"],
                                14 => ["PageMaker","PageMaker","PageMaker","PageMaker","PageMaker"],
                                15 => ["Premiere","Premiere","Premiere","Premiere","Premiere"]
                            ]
                        ]
                    ],
                    [
                        [
                            0 => ["Acrobat"],
                            1 => ["CS","CS","CS","CS","CS"],
                            2 => ["Captivate"],
                            3 => ["ColdFusion","ColdFusion","ColdFusion"],
                            4 => ["ColdBuilder"],
                            5 => ["Contribute","Contribute"],
                            6 => ["eLearning"],
                            7 => ["Director","Director","Director","Director","Director","Director","Director","Director"],
                            8 => ["Fireworks"],
                            9 => ["Flash","Flash","Flash","Flash","Flash"],
                            10 =>["FontFolio","FontFolio","FontFolio","FontFolio","FontFolio"],
                            11 =>["Freehand","Freehand","Freehand"],
                            12 =>["InDesign","InDesign"],
                            13 =>["Lightroom"],
                            14 =>["PageMaker","PageMaker","PageMaker","PageMaker","PageMaker"],
                            15 =>["Premiere"]
                        ],
                        [
                            [
                                0 => ["Acrobat"],
                                1 => ["CS","CS","CS","CS","CS"],
                                2 => ["Captivate"],
                                3 => ["ColdFusion","ColdFusion","ColdFusion"],
                                4 => ["ColdBuilder"]
                            ],
                            [

                                5 => ["Contribute","Contribute"],
                                6 => ["eLearning"],
                                7 => ["Director","Director","Director","Director","Director","Director","Director","Director"],
                                8 => ["Fireworks"],
                            ],
                            [
                                9 => ["Flash","Flash","Flash","Flash","Flash"],
                                10 => ["FontFolio","FontFolio","FontFolio","FontFolio","FontFolio"],
                                11 => ["Freehand","Freehand","Freehand"]
                            ],   
                            [
                                12 => ["InDesign","InDesign"],
                                13 => ["Lightroom"],
                                14 => ["PageMaker","PageMaker","PageMaker","PageMaker","PageMaker"],
                                15 => ["Premiere"]
                            ]
                        ]
                    ],
                    
                    
                    
                ];
	}

        /**
         * @dataProvider dataTest
         */
	public function testSplitArray($input, $output) {
		$this->assertEquals($output, SplitArray::div($input, 4, 1) );
	}

}
