<?php
declare(strict_types=1);

/*
Credit to user "Random Talking Bush" on https://www.spriters-resource.com/ for
the combined image with all the individual Z-Move images in each language:
https://www.spriters-resource.com/3ds/pokemonultrasunultramoon/sheet/104447/
*/

ini_set('memory_limit', '512M');
ini_set('max_execution_time', '0');

require __DIR__ . '/vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

Image::configure(['driver' => 'gd']);

$languages = [
	['identifier' => 'eng', 'offset' =>    1],
	['identifier' => 'fre', 'offset' => 1429],
	['identifier' => 'ger', 'offset' => 2600],
	['identifier' => 'ita', 'offset' => 3771],
	['identifier' => 'spa', 'offset' => 4942],
	['identifier' => 'jpn', 'offset' => 6113],
	['identifier' => 'kor', 'offset' => 7284],
	['identifier' => 'chs', 'offset' => 8455],
	['identifier' => 'cht', 'offset' => 9626],
];

foreach ($languages as $language) {
	$languageIdentifier = $language['identifier'];
	if (!is_dir("images/$languageIdentifier")) {
		mkdir("images/$languageIdentifier");
	}
}

$englishExclusiveNames = [[
	'catastropika',
	'background-02',
	'10-000-000-volt-thunderbolt',
	'stoked-sparksurfer',
	'extreme-evoboost',
	'background-06',
], [
	'pulverizing-pancake',
	'genesis-supernova',
	'background-09',
	'sinister-arrow-raid',
	'background-11',
	'malicious-moonsault',
], [
	'oceanic-operetta',
	'background-14',
	'splintered-stormshards',
	'lets-snuggle-forever',
	'clangorous-soulblaze',
	'background-18',
], [
	'guardian-of-alola',
	'background-20',
	'searing-sunraze-smash',
	'menacing-moonraze-maelstrom',
	'light-that-burns-the-sky',
	'soul-stealing-7-star-strike',
]];

$foreignExclusiveNames = [[
	'catastropika',
	'background-02',
	'10-000-000-volt-thunderbolt',
	'stoked-sparksurfer',
	'extreme-evoboost',
	'pulverizing-pancake',
], [
	'genesis-supernova',
	'sinister-arrow-raid',
	'malicious-moonsault',
	'oceanic-operetta',
	'splintered-stormshards',
	'lets-snuggle-forever',
], [
	'clangorous-soulblaze',
	'guardian-of-alola',
	'searing-sunraze-smash',
	'menacing-moonraze-maelstrom',
	'light-that-burns-the-sky',
	'soul-stealing-7-star-strike',
]];

$typeMoveNames = [[
	'breakneck-blitz',
	'all-out-pummeling',
	'supersonic-skystrike',
	'acid-downpour',
	'tectonic-rage',
	'continental-crush',
], [
	'savage-spin-out',
	'never-ending-nightmare',
	'corkscrew-crash',
	'inferno-overdrive',
	'hydro-vortex',
	'bloom-doom',
], [
	'gigavolt-havoc',
	'shattered-psyche',
	'subzero-slammer',
	'devastating-drake',
	'black-hole-eclipse',
	'twinkle-tackle',
]];

foreach ($languages as $language) {
	$languageIdentifier = $language['identifier'];
	$exclusiveRows = $languageIdentifier === 'eng' ? 4 : 3;

	// Exclusive Z-Moves
	$width = 512;
	$height = 256;
	for ($row = 0; $row < $exclusiveRows; $row++) {
		for ($column = 0; $column < 6; $column++) {
			$x = 1 + $column * 513;
			$y = $language['offset'] + $row * 257;

			$moveIdentifier = $languageIdentifier === 'eng'
				? $englishExclusiveNames[$row][$column]
				: $foreignExclusiveNames[$row][$column];
			$fileName = "images/$languageIdentifier/$moveIdentifier.png";

			Image::make('images/z-moves-all.png')
				->crop($width, $height, $x, $y)
				->save($fileName);
		}
	}

	// Type Z-Moves
	$width = 512;
	$height = 128;
	for ($row = 0; $row < 3; $row++) {
		for ($column = 0; $column < 6; $column++) {
		$x = 1 + $column * 513;
		$y = $language['offset'] + $exclusiveRows * 257 + $row * 129;

		$moveIdentifier = $typeMoveNames[$row][$column];
		$fileName = "images/$languageIdentifier/$moveIdentifier.png";

		Image::make('images/z-moves-all.png')
			->crop($width, $height, $x, $y)
			->save($fileName);
		}
	}
}
