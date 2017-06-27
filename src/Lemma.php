<?php

namespace Skyeng;

final class Lemma {
  const POS_NOUN = 'noun';
  const POS_VERB = 'verb';
  const POS_ADJECTIVE = 'adjective';
  const POS_ADVERB = 'adverb';

  /**
   * @var string
   */
  private $lemma;

  /**
   * @var string|null
   */
  private $partOfSpeech;

  /**
   * @param string $lemma
   * @param string|null $partOfSpeech
   */
  public function __construct($lemma, $partOfSpeech = null) {
    $this->lemma = $lemma;
    $this->partOfSpeech = $partOfSpeech;
  }

  /**
   * @return string
   */
  public function getLemma() {
    return $this->lemma;
  }

  /**
   * @return null|string
   */
  public function getPartOfSpeech() {
    return $this->partOfSpeech;
  }

  /**
   * @param null|string $partOfSpeech
   *
   * @return $this
   */
  public function setPartOfSpeech($partOfSpeech) {
    $this->partOfSpeech = $partOfSpeech;

    return $this;
  }
}
