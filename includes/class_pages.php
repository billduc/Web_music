<?php

/**************************************************************************************
* Class: Pager
* Methods:
* findStart
* findPages
* pageList
* nextPrev
* Redistribute as you see fit.
**************************************************************************************/
class pager
{
/***********************************************************************************
* Ham int findStart (int limit)
* Tra ve dong bat dau cua trang duoc chon dua tren trang lay duoc va bien limit
***********************************************************************************/
	function findstart($limit)
	{
		if ((!isset($_GET['page'])) || ($_GET['page'] == "1"))
		{
			$start = 0;
			$_GET['page'] = 1;
		}
		else
		{
			$start = ($_GET['page']-1) * $limit;
		}
		
		return $start;
	}
/***********************************************************************************
* Ham int findPages (int count, int limit)
* Tra ve so luong trang can thiet dua tren tong so dong co trong table va limit
***********************************************************************************/
	function findpages($count, $limit)
	{
		$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
		return $pages;
	}
/***********************************************************************************
* Ham: string pageList (int curpage, int pages)
* Tra ve danh sach trang theo dinh dang "Trang dau tien  < [cac trang] > Trang cuoi cung"
***********************************************************************************/
	function pageList($curpage, $pages, $url)
	{
		$page_list = "";
	
		/* In trang dau tien va nhung link toi trang truoc neu can */
		if (($curpage != 1) && ($curpage))
		{
			$page_list .= " <a href=\"".$url."&page=1\" title=\"Trang đầu\"><<</a> ";
		}
	
		if (($curpage-1) > 0)
		{
			$page_list .= "<a href=\"".$url."&page=".($curpage-1)."\" title=\"Về trang trước\"><</a> ";
		}
	
		/* In ra danh sach cac trang va lam cho trang hien tai dam hon va mat link o chan*/
		for ($i=1; $i<=$pages; $i++)
		{
			if ($i == $curpage)
			{
				$page_list .= "<b><font class='lightwords'>".$i."</font></b>";
			}
			else
			{
				$page_list .= "<a href=\"".$url."&page=".$i."\" title=\"Trang ".$i."\">".$i."</a>";
			}
			$page_list .= " ";
		}

		/* In link cua trang tiep theo va trang cuoi cung neu can*/
		if (($curpage+1) <= $pages)
		{
			$page_list .= "<a href=\"".$url."&page=".($curpage+1)."\" title=\" Đến trang sau\">></a> ";
		}
		
		if (($curpage != $pages) && ($pages != 0))
		{
			$page_list .= "<a  href=\"".$url."&page=".$pages."\" title=\"Trang cuối\">>></a> ";
		}
		$page_list .= "</td>\n";

	return $page_list;
	}
	
/***********************************************************************************
* Ham string nextPrev (int curpage, int pages)
* Returns "Previous | Next" string for individual pagination (it's a word!)
***********************************************************************************/
	function nextPrev($curpage, $pages, $url)
	{
			
		$next_prev = "";
		
		if (($curpage-1) <= 0)
		{
			$next_prev .= "Về trang trước";
		}
		else
		{
			$next_prev .= "<a href=\"".$url."&page=".($curpage-1)."\">Về trang trước</a>";
		}
		$next_prev .= " | ";
		
		if (($curpage+1) > $pages)
		{
			$next_prev .= "Đến trang sau";
		}
		else
		{
			$next_prev .= "<a href=\"".$url."&page=".($curpage+1)."\">Đến trang sau</a>";
		}
		return $next_prev;
	}
}
?>