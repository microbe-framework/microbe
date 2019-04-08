
<!-- Content { -->

      <h3>Configuration</h3>
      <p>
        After the start an application reads a configuration file.
        By default the configuration file has a name
        <span class="app-span-highlight">'./application/configs/config.txt'.</span>
      </p>
      <p>    
        The configuration file consists of lines of parameters and C-style comments.
        The parameters are pairs of names and values delimited by signs of equality ('=').
      </p>
      <p>
        Parameter groups are called sections.
      </p>
      <table class="app-table-parameters">
        <colgroup>
          <col style="width: 20%">
          <col style="width: 65%">
          <col style="width: 15%">
        </colgroup>
        <caption>
          The configuration file's main sections
        </caption>
        <thead>
          <tr>
            <td>Name</td>
            <td>Description</td>
            <td>Default</td>
          </tr> 
        </thead>
        <tbody>
          <tr>
            <td class="app-table-cell-name">log</td>
            <td class="app-table-cell-description">logging settings</td>
            <td class="app-table-cell-default">disable</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">vars</td>
            <td class="app-table-cell-description">application specific variables settings</td>
            <td class="app-table-cell-default">disable</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">globals</td>
            <td class="app-table-cell-description">application global variables settings</td>
            <td class="app-table-cell-default">disable</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">database</td>
            <td class="app-table-cell-description">database connection parameters</td>
            <td class="app-table-cell-default">disable</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">controller</td>
            <td class="app-table-cell-description">default application controller</td>
            <td class="app-table-cell-default">disable</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">model</td>
            <td class="app-table-cell-description">default application model</td>
            <td class="app-table-cell-default">disable</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">view</td>
            <td class="app-table-cell-description">default application view's renderer</td>
            <td class="app-table-cell-default">disable</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">router</td>
            <td class="app-table-cell-description">default application router</td>
            <td class="app-table-cell-default">disable</td>
          </tr>
        </tbody>
      </table>
      <p>
        Here the sample of <span class="app-span-highlight">log</span> section:
      </p>
      <p class="app-path">
        ./application/configs/config.txt
      </p>
<pre class="app-pre">
...
log.enable = 1
log.class = \App\Classes\AppLog
log.directory = ./tmp/log
...
</pre>
      <table class="app-table-parameters">
        <colgroup>
          <col style="width: 20%">
          <col style="width: 65%">
          <col style="width: 15%">
        </colgroup>
        <caption>
          The configuration file's auxiliary sections
        </caption>
        <thead>
          <tr>
            <td>Name</td>
            <td>Description</td>
            <td>Default</td>
          </tr> 
        </thead>
        <tbody>
          <tr>
            <td class="app-table-cell-name">microbe</td>
            <td class="app-table-cell-description">describe framework related parameters</td>
            <td class="app-table-cell-default"></td>
          </tr>
          <tr>
            <td class="app-table-cell-name">html</td>
            <td class="app-table-cell-description">define HTML meta tag's</td>
            <td class="app-table-cell-default"></td>
          </tr>
          <tr>
            <td class="app-table-cell-name">site</td>
            <td class="app-table-cell-description">define site-specific parameters</td>
            <td class="app-table-cell-default"></td>
          </tr>
        </tbody>
      </table>
  
      <p>
        You can create Your own sections and have access to theirs data from code and views.
      </p>

      <div class="row app-handbook-nav">
        <div class="microbe-col-4-fix microbe-left">
          <!--<a href="<?=$this->getUrl('./handbook');?>">&lt;&lt; Handbook</a>-->
        </div>
      	<div class="microbe-col-4-fix microbe-center">
          <a href="<?=$this->getUrl('./handbook');?>">Handbook</a>
        </div>
      	<div class="microbe-col-4-fix microbe-right">
          <a href="<?=$this->getUrl('./handbook/routing');?>">Routing &gt;&gt;</a>
        </div>
      </div>
  
<!-- } Content -->
