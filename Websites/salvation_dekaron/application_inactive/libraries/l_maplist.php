<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class L_maplist {

    public function maplist()
    {
		$array_map = array("Index" => "Name","0" => "Braiken Castle","3" => "Denebe","5" => "Heihaff","6" => "Parca Temple","7" => "Loa Castle","10" => "Castor Cave","11" => "Frozen Valley of Vengeance","12" => "Crespo","13" => "Draco Desert","14" => "Norak Cave","15" => "Castor Cave 2nd Fl.","16" => "Braiken Castle Underground Prison","17" => "Requies Beach","100" => "Knight Selection Map","101" => "Hunter Selection Map","102" => "Magician Selection Map","103" => "Summoner Selection Map","104" => "Healer Selection Map","105" => "Login","106" => "Bagi Selection Map","107" => "Aloken Selection Map","108" => "Summoner (F) Selection Map","109" => "Healer (M) Selection Map","110" => "New_Login","111" => "New_Login_night","112" => "New_Login_dawn","" => "","524" => "New_Login","525" => "New_Login_night","526" => "New_Login_dawn","" => "","18" => "Avalon Island","19" => "Python Castle","20" => "Tomb of the Black Dragon","21" => "Doomed Maze","22" => "Undo Stadion","23" => "Zenoa Castle","24" => "Magic Field of Crack C","25" => "Crespo's Treasure C","26" => "Aquarius","29" => "Cave of Abyss","30" => "Magic Field of Crack B","31" => "Magic Field of Crack A","32" => "Crespo's Treasure B","33" => "Crespo's Treasure A","34" => "Magic Field of Crack: Depth","" => "","38" => "Test Map","" => "","39" => "Dead Front [Rabble]","40" => "Dead Front [Fear]","41" => "Dead Front [Baron]","42" => "Dead Front [Earl]","43" => "Dead Front [Duke]","44" => "Dead Front [Arc]","45" => "Chain of Fire","46" => "Acquirai Ruins","47" => "Space of Pilgrimage","48" => "Quilue Liana","49" => "Nest of Cherubim","50" => "Morse Yawalai","51" => "The Qualines","52" => "Karon's Transport Ship C","53" => "Karon's Transport Ship B","54" => "Karon's Transport Ship A","55" => "Karon's Transport Ship S","" => "","56" => "Undo Stadion","57" => "Oasis Cartell","58" => "Secret Arena in Norak","59" => "Helicita Colosseum","60" => "Dead Front [Doom]","61" => "Braiken Agency","62" => "Loa Agency","63" => "The Deadlands","64" => "Umbar's Hangout","65" => "Space of Pilgrimage","66" => "Mordo Lumbule","67" => "Egutt Desert","68" => "Egutt Desert Base","69" => "Egutt Desert Base 2","70" => "Avalon Islands","71" => "An Abyss of Crespo","72" => "An Abyss of Crespo -I","73" => "An Abyss of Crespo -II","74" => "An Abyss of Crespo -III","75" => "An Abyss of Crespo -IV","76" => "Karon's Remnants","" => "","77" => "DK_Dead Front [Rabble]","78" => "DK_Dead Front [Fear]","79" => "DK_Dead Front [Baron]","80" => "DK_Dead Front [Earl]","81" => "DK_Dead Front [Duke]","82" => "DK_Dead Front [Arc]","83" => "DK_Dead Front [Doom]","84" => "DK_Chain of Fire","" => "","85" => "Karon's Remnants","86" => "Karon's Remnants","87" => "Karon's Remnants","" => "","88" => "Worshipper's Shelter","89" => "Tower of Spell 1F","90" => "Tower of Spell 2F","91" => "Tower of Spell 3F","92" => "Tower of Spell 4F","93" => "Tower of Spell 5F","94" => "Shadow Shield","95" => "Tower of Spell 1F","96" => "Tower of Spell 2F","97" => "Tower of Spell 3F","98" => "Tower of Spell 4F","99" => "Tower of Spell 5F","" => "","121" => "Karon's Remnants_S","122" => "Karon's Remnants_S","123" => "Karon's Remnants_S","124" => "Karon's Remnants_S","" => "","125" => "Helion's Sactuary_Solo","126" => "Helion's Sactuary_Party","" => "","130" => "Chamber of Confinement","131" => "Chamber of Confinement","132" => "Chamber of Confinement","133" => "Chamber of Confinement","134" => "Chamber of Confinement","135" => "Chamber of Confinement","136" => "Chamber of Confinement","137" => "Chamber of Confinement","138" => "Chamber of Confinement","139" => "Chamber of Confinement","140" => "Chamber of Confinement","141" => "Chamber of Confinement","142" => "Chamber of Confinement","143" => "Chamber of Confinement","144" => "Chamber of Confinement","145" => "Chamber of Confinement","146" => "Chamber of Confinement","147" => "Chamber of Confinement","148" => "Chamber of Confinement","149" => "Chamber of Confinement","" => "","150" => "Ardeca","" => "","151" => "Ruins of Baz","152" => "Ruins of Rudene","" => "","153" => "Secret Arena [Infinite Battle]","154" => "Cartel [Infinite Battle]","155" => "Colosseum [Infinite Battle]","" => "","156" => "Valley Rift","157" => "Land of Illusion","158" => "Ellonom Sanctum","159" => "Ellonom","" => "","160" => "Dead Front [Hell]","161" => "DK_Dead Front [Hell]","" => "","162" => "Colosseum Lobby","163" => "Battle Royale","164" => "Party PvP","165" => "Guild Tournament","" => "","166" => "Hoarfrost Vale","167" => "Ice Castle [Rabble]","168" => "Ice Castle [Fear]","169" => "Ice Castle [Baron]","170" => "Ice Castle [Earl]","171" => "Ice Castle [Duke]","172" => "Ice Castle [Arc]","173" => "Ice Castle [Doom]","174" => "Ice Castle [Hell]","" => "","175" => "Agacion","176" => "Favnil's Nest","177" => "Python Donjon","178" => "Oread","179" => "Tritone","180" => "Elleghos","" => "","181" => "Dravice Secret Passageway","182" => "Dravice Village","183" => "Dravice Field","184" => "Sacred Claw","" => "","200" => "Hunting Challenge","" => "","220" => "Wings Quest","221" => "Trans Up Quest","222" => "Fishing Quest","" => "","65535" => "Map Tool Setting",);

        return $array_map;
    }
	
	
	public function map($map)
	{
		$array_map = $this->maplist();
		return $array_map[$map];
	}
	
	/*
	public function exp_prev_level($level)
	{
		$prev_level = $level - 1;
		$exp_array = $this->exp_array();
		return $exp_array[$prev_level];
	}
	*/
	
}




