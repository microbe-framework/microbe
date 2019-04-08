
<!-- Content { -->

      <h3>Models</h3>
      <p>
        The models are used for access to data sources.
        Models extends framework's php object
        <span class="app-span-highlight">Model</span>
        and have access to all base class properties and methods.
        You can create a model class and place it in
        <span class="app-span-highlight">'./application/Models/'</span> directory.
      </p>
      <p>
        Data source access parameters locates in
        <span class="app-span-highlight">'database'</span> section
        of configuration file.
        All parameters are self-explanatory.
      </p>
      <p class="app-path">
        ./application/configs/config.txt
      </p>
<pre class="app-pre">
...
database.enable = 1
database.driver = mysqli
database.host = localhost
database.port = 3306
database.user = user
database.pass = pass
database.base = test
...
</pre>
      <p>
        Model class must belong to the namespace
        <span class="app-span-highlight">'App\Models'</span>.
        Name of file with model must be same with model's class name:
      </p>
      <p class="app-path">
        ./application/Models/AppModel.php
      </p>
<pre class="app-pre">
namespace App\Models;

class AppModel extends \Microbe\Core\Model
{
    ...
    public function &queryUsers()
    {
        $query = 'SELECT * FROM users';
        return $this->query($query);
    }
    ...
}
</pre>
      <table class="app-table-parameters">
        <colgroup>
          <col style="width: 30%">
          <col style="width: 70">
        </colgroup>
        <caption>
          The most important methods of base class Model
        </caption>
        <thead>
          <tr>
            <td>Method</td>
            <td>Description</td>
          </tr> 
        </thead>
        <tbody>
          <tr>
            <td class="app-table-cell-method">execute($query)</td>
            <td class="app-table-cell-description">execute a
            <span class="app-span-highlight">$query</span>
            and return true if success or false otherwise</td>
          </tr>
          <tr>
            <td class="app-table-cell-method">query($query)</td>
            <td class="app-table-cell-description">execute a
            <span class="app-span-highlight">$query</span>
            and return a php recordset object</td>
          </tr>
          <tr>
            <td class="app-table-cell-method">free($recorset)</td>
            <td class="app-table-cell-description">free a <span class="app-span-highlight">$recordset</span></td>
          </tr>
          <tr>
            <td class="app-table-cell-method">fetch($recorset)</td>
            <td class="app-table-cell-description">fetch row as array from <span class="app-span-highlight">$recordset</span></td>
          </tr>
          <tr>
            <td class="app-table-cell-method">fetchArray($recorset)</td>
            <td class="app-table-cell-description">fetch row as array from <span class="app-span-highlight">$recordset</span></td>
          </tr>
          <tr>
            <td class="app-table-cell-method">fetchAssoc($recorset)</td>
            <td class="app-table-cell-description">fetch row as associative array from <span class="app-span-highlight">$recordset</span></td>
          </tr>
        </tbody>
      </table>
      <p class="app-path">
        ./application/views/some-view.inc.php
      </p>
<pre class="app-pre">
...
&lt?php
    $appModel = new \App\Models\AppModel($this->app);

    $recordset = $appModel->queryUsers();
    while ($row = $appModel->fetchAssoc($recordset)) {
       echo '&lt;p&gt; Name:' . $row['Username'] . '&lt;/p&gt;';
       echo '&lt;p&gt; About:' . $row['About'] . '&lt;/p&gt;';
    }
    $appModel->free($recordset);
?&gt
...
</pre>

      <div class="row app-handbook-nav">
        <div class="microbe-col-4-fix microbe-left">
          <a href="<?=$this->getUrl('./handbook/controllers');?>">&lt;&lt; Controllers</a>
        </div>
        <div class="microbe-col-4-fix microbe-center">
          <a href="<?=$this->getUrl('./handbook');?>">Handbook</a>
        </div>
        <div class="microbe-col-4-fix microbe-right">
          <a href="<?=$this->getUrl('./handbook/views');?>">Views &gt;&gt;</a>
        </div>
      </div>
  
<!-- } Content -->
