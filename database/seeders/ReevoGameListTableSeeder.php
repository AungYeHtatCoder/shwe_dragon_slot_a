<?php

namespace Database\Seeders;

use App\Models\Admin\GameList;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class ReevoGameListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                "code" => "7215",
                "name" => "Sword Of Orleans",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-sword-of-orleans-mobile.png",

            ],
            [
                "code" => "4959",
                "name" => "Farm Ville 2",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-farm-ville-2.png",

            ],
            [
                "code" => "4961",
                "name" => "Fortune Dreams",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-fortune-dreams.png",

            ],
            [
                "code" => "4963",
                "name" => "God of Wealth",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-god-of-wealth.png",

            ],
            [
                "code" => "4965",
                "name" => "Grand Dragon",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-grand-dragon.png",

            ],
            [
                "code" => "4967",
                "name" => "Jade Beauties",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-jade-beauties.png",

            ],
            [
                "code" => "4969",
                "name" => "Mayan's Gold",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-mayans-gold.png",

            ],
            [
                "code" => "4971",
                "name" => "Mighty Spartans",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-mighty-spartans.png",

            ],
            [
                "code" => "5233",
                "name" => "Reels On Fire",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-reels-on-fire-mobile.png",

            ],
            [
                "code" => "4985",
                "name" => "American Ranger",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-american-ranger-mobile.png",

            ],
            [
                "code" => "4987",
                "name" => "Blazing Cash",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-blazing-cash-mobile.png",

            ],
            [
                "code" => "4989",
                "name" => "Blazing Cash 2",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-blazing-cash-2-mobile.png",

            ],
            [
                "code" => "4991",
                "name" => "Bonsai Babies",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-bonsai-babies-mobile.png",

            ],
            [
                "code" => "4993",
                "name" => "Bulls Rush",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-bulls-rush-mobile.png",

            ],
            [
                "code" => "4995",
                "name" => "Dragons Fortune",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-dragons-fortune-mobile.png",

            ],
            [
                "code" => "4997",
                "name" => "Eastern Lions",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-eastern-lions-mobile.png",

            ],
            [
                "code" => "4999",
                "name" => "Emperors Fortress",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-emperors-fortress-mobile.png",

            ],
            [
                "code" => "5001",
                "name" => "Eternal Kingdom",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-eternal-kingdom-mobile.png",

            ],
            [
                "code" => "5003",
                "name" => "Farm Ville 2",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-farm-ville-2-mobile.png",

            ],
            [
                "code" => "5005",
                "name" => "Fortune Dreams",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-fortune-dreams-mobile.png",

            ],
            [
                "code" => "5007",
                "name" => "God of Wealth",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-god-of-wealth-mobile.png",

            ],
            [
                "code" => "5009",
                "name" => "Grand Dragon",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-grand-dragon-mobile.png",

            ],
            [
                "code" => "5011",
                "name" => "Jade Beauties",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-jade-beauties-mobile.png",

            ],
            [
                "code" => "5013",
                "name" => "Mayan's Gold",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-mayans-gold-mobile.png",

            ],
            [
                "code" => "5015",
                "name" => "Mighty Spartans",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-mighty-spartans-mobile.png",

            ],
            [
                "code" => "5017",
                "name" => "Pirate Queen",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-pirate-queen-mobile.png",

            ],
            [
                "code" => "5019",
                "name" => "Tiger's Fortune",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-tigers-fortune-mobile.png",

            ],
            [
                "code" => "5021",
                "name" => "Vampire's Eclipse",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-vampires-eclipse-mobile.png",

            ],
            [
                "code" => "5023",
                "name" => "Vegas Star",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-vegas-star-mobile.png",

            ],
            [
                "code" => "5025",
                "name" => "Precious Egypt",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-precious-egypt-mobile.png",

            ],
            [
                "code" => "5027",
                "name" => "Shaman's Spirit",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-shamans-spirit-mobile.png",

            ],
            [
                "code" => "5043",
                "name" => "Leicester Codex",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-leicester-codex.png",

            ],
            [
                "code" => "5051",
                "name" => "Secret of Atlantis",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-secret-of-atlantis-mobile.png",

            ],
            [
                "code" => "5055",
                "name" => "Teslas Dream",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-teslas-dream-mobile.png",

            ],
            [
                "code" => "5057",
                "name" => "Leicester Codex",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-leicester-codex-mobile.png",

            ],
            [
                "code" => "8129",
                "name" => "Welcome To KTV",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-welcome-to-ktv-mobile.png",

            ],
            [
                "code" => "5061",
                "name" => "Zilionaire",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-zilionaire-mobile.png",

            ],
            [
                "code" => "5063",
                "name" => "Jackpot Bank",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-jackpot-bank.png",

            ],
            [
                "code" => "5065",
                "name" => "Jackpot Bank",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-jackpot-bank-mobile.png",

            ],
            [
                "code" => "5069",
                "name" => "Farm Ville",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-farm-ville-mobile.png",

            ],
            [
                "code" => "5071",
                "name" => "Immortal Rider",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-immortal-rider.png",

            ],
            [
                "code" => "5073",
                "name" => "Immortal Rider",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-immortal-rider-mobile.png",

            ],
            [
                "code" => "5077",
                "name" => "Exotic Gems",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-exotic-gems-mobile.png",

            ],
            [
                "code" => "5081",
                "name" => "Claudius Lust",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-claudius-lust-mobile.png",

            ],
            [
                "code" => "5085",
                "name" => "Three Emperors",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-three-emperors-mobile.png",

            ],
            [
                "code" => "8161",
                "name" => "Christmas Farm",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-christmas-farm-mobile.png",

            ],
            [
                "code" => "5609",
                "name" => "The Four Creatures",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-the-four-creatures.png",

            ],
            [
                "code" => "5613",
                "name" => "The Four Creatures",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-the-four-creatures-mobile.png",

            ],
            [
                "code" => "5615",
                "name" => "Animal Zodiac",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-animal-zodiac-mobile.png",

            ],
            [
                "code" => "6141",
                "name" => "Eternal Kingdom 2",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-eternal-kingdom-2-mobile.png",

            ],
            [
                "code" => "11039",
                "name" => "CandyMania",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-candymania-mobile.png",

            ],
            [
                "code" => "15137",
                "name" => "Wolf's Quest",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-wolfs-quest-mobile.png",

            ],
            [
                "code" => "16177",
                "name" => "Cosmos Warriors",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-cosmos-warriors-mobile.png",

            ],
            [
                "code" => "11633",
                "name" => "Egyptian Book",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-egyptian-book-mobile.png",

            ],
            [
                "code" => "12949",
                "name" => "Chili Desert",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-chili-desert-mobile.png",

            ],
            [
                "code" => "16035",
                "name" => "Magic Runes",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-magic-runes.png",

            ],
            [
                "code" => "16037",
                "name" => "Magic Runes",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-magic-runes-mobile.png",

            ],
            [
                "code" => "9401",
                "name" => "Circus Of Freaks",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-circus-of-freaks-mobile.png",

            ],
            [
                "code" => "9935",
                "name" => "Peters Galaxy",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-peters-galaxy-mobile.png",

            ],
            [
                "code" => "14813",
                "name" => "Coins of Luck",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-coins-of-luck-mobile.png",

            ],
            [
                "code" => "10209",
                "name" => "Desert Wishes",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-desert-wishes-mobile.png",

            ],
            [
                "code" => "12529",
                "name" => "Monkey Corsairs",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-monkey-corsairs.png",

            ],
            [
                "code" => "12531",
                "name" => "Monkey Corsairs",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-monkey-corsairs-mobile.png",

            ],
            [
                "code" => "14325",
                "name" => "Dragon Storyteller",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-dragon-storyteller-mobile.png",

            ],
            [
                "code" => "910083",
                "name" => "Ali Babas Lanterns",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-ali-babas-lanterns.png",

            ],
            [
                "code" => "910085",
                "name" => "Wild Mega Bunny",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-wild-mega-bunny.png",

            ],
            [
                "code" => "910089",
                "name" => "Bubble Dreams",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-bubble-dreams.png",

            ],
            [
                "code" => "910091",
                "name" => "Soccer Legends",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-soccer-legends.png",

            ],
            [
                "code" => "21535",
                "name" => "Kakadu Sunset",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-kakadu-sunset.png",

            ],
            [
                "code" => "21537",
                "name" => "Kakadu Sunset",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-kakadu-sunset-mobile.png",

            ],
            [
                "code" => "910115",
                "name" => "Kitty Cats",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-kitty-cats-mobile.png",

            ],
            [
                "code" => "910117",
                "name" => "Legend of Cleopatra",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-legend-of-cleopatra-mobile.png",

            ],
            [
                "code" => "22105",
                "name" => "Aloha Christmas Pokie",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-aloha-christmas-pokie.png",

            ],
            [
                "code" => "22107",
                "name" => "Aloha Christmas Pokie",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-aloha-christmas-pokie-mobile.png",

            ],
            [
                "code" => "25959",
                "name" => "Bubble Dreams",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-bubble-dreams-mobile.png",

            ],
            [
                "code" => "17273",
                "name" => "Starstruck",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-starstruck.png",

            ],
            [
                "code" => "909949",
                "name" => "Kitty Cats",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-kitty-cats.png",

            ],
            [
                "code" => "909951",
                "name" => "Teslas Dream",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-teslas-dream.png",

            ],
            [
                "code" => "909955",
                "name" => "Legend of Cleopatra",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-legend-of-cleopatra.png",

            ],
            [
                "code" => "909957",
                "name" => "Secret of Atlantis",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-secret-of-atlantis.png",

            ],
            [
                "code" => "909961",
                "name" => "Zilionaire",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-zilionaire.png",

            ],
            [
                "code" => "909965",
                "name" => "Farm Ville",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-farm-ville.png",

            ],
            [
                "code" => "18321",
                "name" => "Sheriff's Justice",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-sheriffs-justice-mobile.png",

            ],
            [
                "code" => "909969",
                "name" => "Blazing Cash 2",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-blazing-cash-2.png",

            ],
            [
                "code" => "909971",
                "name" => "Exotic Gems",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-exotic-gems.png",

            ],
            [
                "code" => "909973",
                "name" => "Vegas Star",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-vegas-star.png",

            ],
            [
                "code" => "19351",
                "name" => "End of the World Quest",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-end-of-the-world-quest-mobile.png",

            ],
            [
                "code" => "909975",
                "name" => "Blazing Cash",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-blazing-cash.png",

            ],
            [
                "code" => "24989",
                "name" => "Wild Mega Bunny",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-wild-mega-bunny-mobile.png",

            ],
            [
                "code" => "909983",
                "name" => "Eastern Lions",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-eastern-lions.png",

            ],
            [
                "code" => "909985",
                "name" => "Precious Egypt",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-precious-egypt.png",

            ],
            [
                "code" => "916385",
                "name" => "Starstruck",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-starstruck-mobile.png",

            ],
            [
                "code" => "909987",
                "name" => "Claudius Lust",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-claudius-lust.png",

            ],
            [
                "code" => "916387",
                "name" => "Piggy Ironside — Muspelheim's Treasure",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-piggy-ironside-mobile.png",

            ],
            [
                "code" => "909989",
                "name" => "Dragons Fortune",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-dragons-fortune.png",

            ],
            [
                "code" => "916389",
                "name" => "Soccer Legends",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-soccer-legends-mobile.png",

            ],
            [
                "code" => "909991",
                "name" => "Bonsai Babies",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-bonsai-babies.png",

            ],
            [
                "code" => "909993",
                "name" => "Three Emperors",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-three-emperors.png",

            ],
            [
                "code" => "909995",
                "name" => "Shaman's Spirit",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-shamans-spirit.png",

            ],
            [
                "code" => "909999",
                "name" => "American Ranger",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-american-ranger.png",

            ],
            [
                "code" => "910003",
                "name" => "Tiger's Fortune",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-tigers-fortune.png",

            ],
            [
                "code" => "910005",
                "name" => "Vampire's Eclipse",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-vampires-eclipse.png",

            ],
            [
                "code" => "910007",
                "name" => "Pirate Queen",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-pirate-queen.png",

            ],
            [
                "code" => "910009",
                "name" => "Emperors Fortress",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-emperors-fortress.png",

            ],
            [
                "code" => "910011",
                "name" => "Bulls Rush",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-bulls-rush.png",

            ],
            [
                "code" => "910015",
                "name" => "Eternal Kingdom",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-eternal-kingdom.png",

            ],
            [
                "code" => "910017",
                "name" => "Reels On Fire",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-reels-on-fire.png",

            ],
            [
                "code" => "24515",
                "name" => "Ali Babas Lanterns",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-ali-babas-lanterns-mobile.png",

            ],
            [
                "code" => "910021",
                "name" => "Animal Zodiac",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-animal-zodiac.png",

            ],
            [
                "code" => "910023",
                "name" => "Eternal Kingdom 2",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-eternal-kingdom-2.png",

            ],
            [
                "code" => "910025",
                "name" => "Welcome To KTV",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-welcome-to-ktv.png",

            ],
            [
                "code" => "910027",
                "name" => "Sword Of Orleans",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-sword-of-orleans.png",

            ],
            [
                "code" => "19661",
                "name" => "Hawaiian Pokie",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-hawaiian-pokie.png",

            ],
            [
                "code" => "20173",
                "name" => "Piggy Detective",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-piggy-detective-mobile.png",

            ],
            [
                "code" => "910029",
                "name" => "Christmas Farm",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-christmas-farm.png",

            ],
            [
                "code" => "19663",
                "name" => "Hawaiian Pokie",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-hawaiian-pokie-mobile.png",

            ],
            [
                "code" => "910031",
                "name" => "Circus Of Freaks",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-circus-of-freaks.png",

            ],
            [
                "code" => "910033",
                "name" => "Peters Galaxy",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-peters-galaxy.png",

            ],
            [
                "code" => "910035",
                "name" => "Desert Wishes",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-desert-wishes.png",

            ],
            [
                "code" => "910037",
                "name" => "CandyMania",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-candymania.png",

            ],
            [
                "code" => "910041",
                "name" => "Egyptian Book",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-egyptian-book.png",

            ],
            [
                "code" => "17371",
                "name" => "Alchemy Book",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-alchemy-book-mobile.png",

            ],
            [
                "code" => "910045",
                "name" => "Chili Desert",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-chili-desert.png",

            ],
            [
                "code" => "910047",
                "name" => "Dragon Storyteller",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-dragon-storyteller.png",

            ],
            [
                "code" => "910049",
                "name" => "Coins of Luck",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-coins-of-luck.png",

            ],
            [
                "code" => "21219",
                "name" => "El Bisonte",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-el-bisonte-mobile.png",

            ],
            [
                "code" => "910051",
                "name" => "Wolf's Quest",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-wolfs-quest.png",

            ],
            [
                "code" => "23271",
                "name" => "Mariachi Party",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-mariachi-party.png",

            ],
            [
                "code" => "910055",
                "name" => "Cosmos Warriors",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-cosmos-warriors.png",

            ],
            [
                "code" => "23273",
                "name" => "Mariachi Party",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-mariachi-party-mobile.png",

            ],
            [
                "code" => "24043",
                "name" => "Golden Sheila",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-golden-sheila.png",

            ],
            [
                "code" => "24045",
                "name" => "Golden Sheila",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-golden-sheila-mobile.png",

            ],
            [
                "code" => "910061",
                "name" => "Alchemy Book",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-alchemy-book.png",

            ],
            [
                "code" => "910063",
                "name" => "Sheriff's Justice",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-sheriffs-justice.png",

            ],
            [
                "code" => "910067",
                "name" => "End of the World Quest",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-end-of-the-world-quest.png",

            ],
            [
                "code" => "16885",
                "name" => "Fruits & Bubbles",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-fruits-&-bubbles.png",

            ],
            [
                "code" => "16887",
                "name" => "Fruits & Bubbles",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-fruits-&-bubbles-mobile.png",

            ],
            [
                "code" => "910071",
                "name" => "Piggy Detective",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-piggy-detective.png",

            ],
            [
                "code" => "910073",
                "name" => "El Bisonte",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-el-bisonte.png",

            ],
            [
                "code" => "18939",
                "name" => "Gods vs Titans",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-gods-vs-titans.png",

            ],
            [
                "code" => "18941",
                "name" => "Gods vs Titans",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-gods-vs-titans-mobile.png",

            ],
            [
                "code" => "909309",
                "name" => "Piggy Ironside — Muspelheim's Treasure",
                "game_type_id" => 1,
                "product_id" => 15,
                "image_url" => "https://stage-aggr.reevotech.com/media/images/slots/small/lu/lu-piggy-ironside.png",

            ]
        ];

        GameList::insert($data);
    }
}
