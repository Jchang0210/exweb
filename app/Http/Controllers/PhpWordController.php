<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Session;
use App\Category;

class PhpWordController extends Controller
{
	function getword() {
        $questions = Session::get('questions');
        $examName = Session::get('examname');

		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$center = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
		$fontType = array('name' => '標楷體');
		$fontTitle = array('name' => '標楷體', 'size' => 20);
		$fontBold = array('name' => '標楷體', 'bold' => true);
		$fontUnderline = array('name' => '標楷體', 'underline' => 'single');


		$section = $phpWord->addSection();
		$section->addText($examName, $fontTitle, $center);

		$i = 0;
		foreach ($questions as $question) {
			$i++;
			$textrun = $section->addTextRun();
			$textrun->addText('(	) ', $fontType);
			$textrun->addText($i . '. ', $fontType);
			$textrun->addText($question['question'] . ' ', $fontType);
			if ($question['type'] == '2') {
				$textrun->addText('(A)' . $question['option1'] . ' ', $fontType);
				$textrun->addText('(B)' . $question['option2'] . ' ', $fontType);
				$textrun->addText('(C)' . $question['option3'] . ' ', $fontType);
				$textrun->addText('(D)' . $question['option4'] . ' ', $fontType);
				if (!empty($question['option5'])) {
					$textrun->addText('(E)' . $question['option5'] . ' ', $fontType);
				}
				$textrun->addText('(' . Category::find($question['category_id'])['name'] . ')', $fontBold);
				$section->addTextBreak();
			} else {
				$textrun->addText('(' . Category::find($question['category_id'])['name'] . ')', $fontBold);
				$section->addTextBreak(3);
			}
		}

		$section = $phpWord->addSection();
		$section->addText($examName, $fontTitle, $center);

		$i = 0;
		foreach ($questions as $question) {
			$i++;
			$textrun = $section->addTextRun();
			$textrun->addText('(	) ', $fontType);
			$textrun->addText($i . '. ', $fontType);
			$textrun->addText($question['question'] . ' ', $fontType);
			if ($question['type'] == '2') {
				$textrun->addText('(A)' . $question['option1'] . ' ', $fontType);
				$textrun->addText('(B)' . $question['option2'] . ' ', $fontType);
				$textrun->addText('(C)' . $question['option3'] . ' ', $fontType);
				$textrun->addText('(D)' . $question['option4'] . ' ', $fontType);
				if (!empty($question['option5'])) {
					$textrun->addText('(E)' . $question['option5'] . ' ', $fontType);
				}
				$textrun->addText('(' . Category::find($question['category_id'])['name'] . ')', $fontBold);

				$section->addText('Answer : ' . $question['answer'], $fontUnderline);
			} else {
				$textrun->addText('(' . Category::find($question['category_id'])['name'] . ')', $fontBold);
				$section->addText('Answer : ' . $question['answer'], $fontUnderline);
			}
		}

		// --------------------------------
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save(storage_path('測試計畫1.docx'));
		// -----------------------------

		return response()->download(storage_path('測試計畫1.docx'));
	}
}
