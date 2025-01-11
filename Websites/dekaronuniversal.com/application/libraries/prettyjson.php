<?php

class PrettyJSON
{
	private $json;

	public function __construct($raw)
	{
		$this->json = json_encode($raw);

		$this->main();
	}

	private function main()
	{
		$this->json = preg_replace("/\{/", "\n{\n", $this->json);
		$this->json = preg_replace("/^\n{/", "{", $this->json);
		$this->json = preg_replace("/\}/", "\n}", $this->json);
		$this->json = preg_replace("/\]/", "\n]\n", $this->json);
		$this->json = preg_replace("/\[/", "\n[\n", $this->json);
		$this->json = preg_replace("/,/", ",\n", $this->json);
		$this->indent();
	}

	private function indent()
	{
		$lines = explode("\n", $this->json);
	
		$indent = 0;

		foreach($lines as $key => $line)
		{
			$lines[$key] = $this->getIndent($indent).$line;

			switch($line)
			{
				case "{":
					$indent++;
				break;

				case "},":
					$indent--;
					$lines[$key] = $this->getIndent($indent).$line;
				break;

				case "}":
					$indent--;
					$lines[$key] = $this->getIndent($indent).$line;
				break;

				case "[":
					$indent++;
				break;

				case "],":
					$indent--;
					$lines[$key] = $this->getIndent($indent).$line;
				break;

				case "]":
					$indent--;
					$lines[$key] = $this->getIndent($indent).$line;
				break;
			}
		}

		$this->json = implode("\n", $lines);
	}

	private function getIndent($count)
	{
		if(!$count)
		{
			return "";
		}

		$string = "";

		for($i = 0;$i < $count;$i++)
		{
			$string .= "	";
		}

		return $string;
	}

	public function get()
	{
		return $this->json;
	}
}