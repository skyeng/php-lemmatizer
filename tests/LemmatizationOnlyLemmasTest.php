<?php

use Skyeng\Lemma;
use Skyeng\Lemmatizer;

class LemmatizationOnlyLemmasTest extends PHPUnit_Framework_TestCase {
  /**
   * @var Lemmatizer
   */
  private static $lemmatizer;

  public static function setUpBeforeClass() {
    self::$lemmatizer = new Lemmatizer();
  }

  /**
   * Lemmatizer leaves alone words that its dictionary does not contain.
   */
  public function testLemmatizationUnknownWord() {
    $this->assertEquals(self::$lemmatizer->getOnlyLemmas('MacBooks', 'noun'), ['MacBooks']);
  }

  /**
   * Lemmatizer leaves alone non-existing words.
   */
  public function testLemmatizationNotExistingWord() {
    $this->assertEquals(self::$lemmatizer->getOnlyLemmas('abcdefg'), ['abcdefg']);
  }

  /**
   * @return array
   */
  public function withPosProvider() {
    return [
      [['wives', Lemma::POS_NOUN], ['wife']],
      [['desks', Lemma::POS_NOUN], ['desk']],
      [['hired', Lemma::POS_VERB], ['hire']],
      [['worried', Lemma::POS_VERB], ['worry']],
      [['partying', Lemma::POS_VERB], ['party']],
      [['better', Lemma::POS_ADJECTIVE], ['better', 'good']],
      [['hotter', Lemma::POS_ADJECTIVE], ['hot']],
      [['best', Lemma::POS_ADVERB], ['best', 'well']],
      [['best', Lemma::POS_ADJECTIVE], ['best', 'good']],
      [['goes', Lemma::POS_VERB], ['go']],
      [['went', Lemma::POS_VERB], ['go']],
      [['gone', Lemma::POS_VERB], ['go']],
      [['writes', Lemma::POS_VERB], ['write']],
      [['wrote', Lemma::POS_VERB], ['write']],
      [['written', Lemma::POS_VERB], ['write']],
      [['confirms', Lemma::POS_VERB], ['confirm']],
      [['confirmed', Lemma::POS_VERB], ['confirm']],
      [['confirming', Lemma::POS_VERB], ['confirm']],
      [['acidless', Lemma::POS_NOUN], ['acidless']],
      [['pizzas', Lemma::POS_NOUN], ['pizza']],
      [['foxes', Lemma::POS_NOUN], ['fox']],
      [['hacked', Lemma::POS_VERB], ['hack']],
      [['hacking', Lemma::POS_VERB], ['hack']],
      [['coded', Lemma::POS_VERB], ['code']],
      [['coding', Lemma::POS_VERB], ['code']],
      [['fitting', Lemma::POS_VERB], ['fit']],
      [['pirouetting', Lemma::POS_VERB], ['pirouette']],
      [['earliest', Lemma::POS_ADJECTIVE], ['earliest', 'early']],
      [['biggest', Lemma::POS_ADJECTIVE], ['big']],
      [['largest', Lemma::POS_ADJECTIVE], ['large']],
      [['smallest', Lemma::POS_ADJECTIVE], ['small']],
      [['earlier', Lemma::POS_ADJECTIVE], ['earlier', 'early']],
      [['bigger', Lemma::POS_ADJECTIVE], ['bigger', 'big']],
      [['larger', Lemma::POS_ADJECTIVE], ['larger', 'large']],
      [['smaller', Lemma::POS_ADJECTIVE], ['smaller', 'small']],
      [['recognizable', Lemma::POS_ADJECTIVE], ['recognizable']],
      [['networkable', Lemma::POS_ADJECTIVE], ['networkable']],
      [['resettability', Lemma::POS_NOUN], ['resettability']],
      [['repairability', Lemma::POS_NOUN], ['repairability']],
      [['reorganizability', Lemma::POS_NOUN], ['reorganizability']],
      [['starts', Lemma::POS_VERB], ['start']],
      [['teaches', Lemma::POS_VERB], ['teach']],
      [['talked', Lemma::POS_VERB], ['talk']],
      [['saved', Lemma::POS_VERB], ['save']],
      [['sitting', Lemma::POS_VERB], ['sit']],
      [['having', Lemma::POS_VERB], ['have']],
      [['talking', Lemma::POS_VERB], ['talk']],
      [['heavier', Lemma::POS_ADJECTIVE], ['heavy']],
      [['bigger', Lemma::POS_ADJECTIVE], ['bigger', 'big']],
      [['huger', Lemma::POS_ADJECTIVE], ['huge']],
      [['hugest', Lemma::POS_ADJECTIVE], ['huge']],
      [['lower', Lemma::POS_ADJECTIVE], ['low']],
      [['writable', Lemma::POS_ADJECTIVE], ['writable']],
      [['readable', Lemma::POS_ADJECTIVE], ['readable']],
      [['readability', Lemma::POS_NOUN], ['readability']],
      [['writability', Lemma::POS_NOUN], ['writability']],
      [['scoreless', Lemma::POS_NOUN], ['scoreless']],
      [['dogs', Lemma::POS_NOUN], ['dog']],
      [['dishes', Lemma::POS_NOUN], ['dish']],
      [['heaviest', Lemma::POS_ADJECTIVE], ['heavy']],
      [['lowest', Lemma::POS_ADJECTIVE], ['lowest', 'low']],
      [['higher', Lemma::POS_ADJECTIVE], ['higher', 'high']],
      [['leaves', Lemma::POS_NOUN], ['leave', 'leaf']],
      [['player', Lemma::POS_NOUN], ['player']],
      [['priorities', Lemma::POS_NOUN], ['priority']],
      [['matter', Lemma::POS_VERB], ['matter']],
      [['matter', Lemma::POS_NOUN], ['matter']],
      [['matter', Lemma::POS_ADJECTIVE], ['matte', 'matt', 'mat']],
      [['added', Lemma::POS_VERB], ['add']],
      [['opposes', Lemma::POS_VERB], ['oppose']],
      [['singing', Lemma::POS_VERB], ['sing']],
      [['dying', Lemma::POS_VERB], ['die']],
      [['after', Lemma::POS_ADVERB], ['after', 'aft']],
      [['us', Lemma::POS_NOUN], ['us']],
    ];
  }

  /**
   * Lemmatize a word with a part of speech (pos).
   *
   * @dataProvider withPosProvider
   *
   * @param array $wordWithPos
   * @param Lemma[] $expectedResult
   */
  public function testLemmatizationWithPos(array $wordWithPos, array $expectedResult) {
    $lemmas = self::$lemmatizer->getOnlyLemmas(...$wordWithPos);
    $message = 'Expected lemmas: ' . implode(', ', $expectedResult) . "\n";
    $message .= 'Actual lemmas: ' . implode(', ', $lemmas) . "\n";

    $this->assertEquals(count($expectedResult), count($lemmas), $message);
    foreach($expectedResult as $expectedLemma) {
      $this->assertContains($expectedLemma, $lemmas, $message, false, false);
    }
  }

  /**
   * @return array
   */
  public function withoutPosProvider() {
    return [
      [['wives'], ['wife', 'wive']],
      [['plays'], ['play']],
      [['oxen'], ['oxen', 'ox']],
      [['fired'], ['fire', 'fired']],
      [['slower'], ['slower', 'slow']],
      [['goes'], ['go']],
      [['went'], ['go']],
      [['gone'], ['go', 'gone']],
      [['writes'], ['write']],
      [['wrote'], ['write']],
      [['written'], ['write', 'written']],
      [['confirms'], ['confirm']],
      [['confirmed'], ['confirm', 'confirmed']],
      [['confirming'], ['confirm', 'confirming']],
      [['acidless'], ['acidless']],
      [['pizzas'], ['pizza']],
      [['foxes'], ['fox']],
      [['hacked'], ['hack']],
      [['coded'], ['code']],
      [['coding'], ['code', 'coding']],
      [['fitting'], ['fit', 'fitting']],
      [['pirouetting'], ['pirouette']],
      [['hacking'], ['hack']],
      [['earliest'], ['earliest', 'early']],
      [['biggest'], ['big']],
      [['largest'], ['large']],
      [['smallest'], ['small']],
      [['bigger'], ['big', 'bigger']],
      [['earlier'], ['earlier', 'early']],
      [['larger'], ['large', 'larger']],
      [['smaller'], ['small', 'smaller']],
      [['recognizable'], ['recognize', 'recognizable']],
      [['networkable'], ['network']],
      [['resettability'], ['reset']],
      [['repairability'], ['repair']],
      [['reorganizability'], ['reorganize']],
      [['starts'], ['start']],
      [['teaches'], ['teach']],
      [['talked'], ['talk']],
      [['saved'], ['save', 'saved']],
      [['sitting'], ['sit', 'sitting']],
      [['having'], ['have']],
      [['talking'], ['talk', 'talking']],
      [['heavier'], ['heavy']],
      [['bigger'], ['big', 'bigger']],
      [['huger'], ['huge']],
      [['lower'], ['lower', 'low']],
      [['writable'], ['write']],
      [['readable'], ['read', 'readable']],
      [['resettable'], ['reset']],
      [['readability'], ['read', 'readability']],
      [['writability'], ['write']],
      [['scoreless'], ['scoreless']],
      [['dogs'], ['dog']],
      [['dishes'], ['dish']],
      [['heaviest'], ['heavy']],
      [['biggest'], ['big']],
      [['hugest'], ['huge']],
      [['lowest'], ['lowest', 'low']],
      [['higher'], ['high', 'higher']],
      [['leaves'], ['leave', 'leaf']],
      [['player'], ['player']],
      [['priorities'], ['priority']],
      [['matter'], ['matter', 'matte', 'matt', 'mat']],
      [['added'], ['add']],
      [['opposes'], ['oppose']],
      [['singing'], ['sing', 'singing']],
      [['dying'], ['die', 'dying']],
      [['after'], ['after', 'aft']],
      [['us'], ['us']],
    ];
  }

  /**
   * Lemmatizer leaves alone words that its dictionary does not contain.
   *
   * @dataProvider withoutPosProvider
   *
   * @param array $wordWithoutPos
   * @param Lemma[] $expectedResult
   */
  public function testLemmatizationWithoutPos(array $wordWithoutPos, array $expectedResult) {
    $lemmas = self::$lemmatizer->getOnlyLemmas(...$wordWithoutPos);
    $message = 'Expected lemmas: ' . implode(', ', $expectedResult) . "\n";
    $message .= 'Actual lemmas: ' . implode(', ', $lemmas) . "\n";

    $this->assertEquals(count($expectedResult), count($lemmas), $message);
    foreach($expectedResult as $expectedLemma) {
      $this->assertContains($expectedLemma, $lemmas, $message, false, false);
    }
  }
}
