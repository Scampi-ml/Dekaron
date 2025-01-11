<?php
class News_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getArticles($start = 0, $limit = 1)
	{
		if($start === true)
		{
			$this->db->select('id, headline, content, timestamp');
		}
		else
		{
			$this->db->select('id, headline, content, timestamp');
			$this->db->limit($limit, $start);
		}

		$this->db->order_by('id', 'desc');
		$query = $this->db->get('articles');
		$result = $query->result_array();

		if($result)
		{
			return $this->template->format($result);
		}
		else
		{
			return array(
						array(
							'id' => 0,
							'headline' => 'Welcome to DekaronCMS!',
							'content' => 'Welcome to your new website! This news article will disappear as soon as you add a new one.',
							'timestamp' => time()
						)
					);
		}
	}

	public function getArticle($id)
	{
		$query = $this->db->query("SELECT * FROM articles WHERE id=?", array($id));

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();

			return $result[0];
		}
		else
		{
			return false;
		}
	}

	public function countArticles()
	{
		return $this->db->count_all('articles');
	}

	public function articleExists($id)
	{
		if (!$id)
		{
			return false;
		}

		$this->db->where('id', $id);
		$query = $this->db->get('articles');
		$result = $query->result_array();

		if(count($result))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function create($headline, $content)
	{
		if (!is_string($headline) || !is_string($content))
		{
			return false;
		}

		$data = array(
			'headline' => $headline,
			'content' => $content,
			'timestamp' => time()
		);
		$this->db->insert("articles", $data);
		return true;
	}

	public function update($id, $headline, $content)
	{
		if (!is_numeric($id) || !is_string($headline) || !is_string($content))
			return false;

		$data = array(
			'headline' => $headline,
			'content' => $content,
		);

		$this->db->where('id', $id);
		$this->db->update("articles", $data);
		return true;
	}

	public function delete($articleId)
	{
		if (!is_numeric($articleId))
		{
			return false;
		}

		$this->db->where('id', $articleId);
		$this->db->delete('articles');
		return true;
	}
}
