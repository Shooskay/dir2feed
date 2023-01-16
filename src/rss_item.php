<?php
require_once("mediainfo.php");
class Item{
    public $url_base;
    public $author;
    public $media_info;
    public $url;
    public function __construct($file_path,$url_base,$author){
        $this->url_base = $url_base;
        $this->author = $author;
        $this->media_info = New MediaInfo($file_path) ;#create_mediainfo($file_path);
        $this->url = $this->url_base.'/'.urlencode($this->media_info->filename);
    }
    public function disp(){
        echo <<<EndOfItem
            <item>
              <link>{$this->url}</link>
              <title>{$this->media_info->title}</title>
              <author>{$this->author}</author>
              <description>{$this->media_info->description}</description>
              <pubDate>{$this->media_info->pubDate}</pubDate>
              <enclosure url="{$this->url}" length="{$this->media_info->length}" type="{$this->media_info->type}" />
              <itunes:author>{$this->media_info->itunes_author}</itunes:author>
              <itunes:summary>{$this->media_info->itunes_summary}</itunes:summary>
              <itunes:subtitle>{$this->media_info->itunes_subtitle}</itunes:subtitle>
              <itunes:keywords>{$this->media_info->itunes_keywords}</itunes:keywords>
              <itunes:duration>{$this->media_info->itunes_duration}</itunes:duration>
              <guid isPermaLink="false">{$this->url}</guid>
            </item>\n
        EndOfItem;
        
    }
}
?>