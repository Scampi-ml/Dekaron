<?php

class News_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Get news entries
	 * @param Int $start
	 * @param Int $limit
	 * @return Array
	 */
	public function getArticles($start = 0, $limit = 1)
	{
		if($start === true)
		{
			$this->db->select('id, headline, content, timestamp, author_id');
		}
		else
		{
			$this->db->select('id, headline, content, timestamp, author_id');
			$this->db->limit($limit, $start);
		}

		$this->db->order_by('id', 'desc');
		$query = $this->db->get('articles');
		$result = $query->result_array();

		// Did we have any results?
		if($result)
		{
			return $this->template->format($result);
		}
		else
		{
			// Instead of showing a blank space, we show a default article
			return array(
						array(
							'id' => 0,
							'headline' => 'Welcome to DekaronCMS V1!',
							'content' => 'Welcome to your new website! This news article will disappear as soon as you add a new one.',
							'author_id' => 0,
							'timestamp' => time(),
						)
					);
		}
	}

	/**
	 * Get the article with the specified id.
	 * @param $id
	 * @return bool
	 */
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
	/**
	 * Count the articles
	 * @return Int
	 */
	public function countArticles()
	{
		return $this->db->count_all('articles');
	}

	/**
	 * Check whether an article exists or not
	 * @param Int $id
	 * @param Boolean $comment Check if comments are enabled
	 * @return bool
	 */
	public function articleExists($id)
	{
		if (!$id)
			return false;

		$this->db->select('comments');
		$this->db->where('id', $id);
		$query = $this->db->get('articles');

		$result = $query->result_array();
	}

	/**
	 * Create a news article
	 * @param $headline
	 * @param $avatar
	 * @param $comments
	 * @param $content
	 * @return bool
	 */
	public function create($headline, $content)
	{
		if (!is_string($headline) || !is_string($content))
			return false;

		$data = array(
			'headline' => $headline,
			'content' => $content,
			'timestamp' => time(),
			'author_id' => $this->user->getId()
		);

		$this->db->insert("articles", $data);

		return true;
	}

	/**
	 * Update the article with the given id
	 * @param $id
	 * @param $headline
	 * @param $avatar
	 * @param $comments
	 * @param $content
	 * @return bool
	 */
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

	/**
	 * Delete the article with the given id.
	 * @param $articleId
	 * @return bool
	 */
	public function delete($articleId)
	{
		if (!is_numeric($articleId))
			return false;

		$this->db->where('id', $articleId);
		$this->db->delete('articles');

		return true;
	}
}
