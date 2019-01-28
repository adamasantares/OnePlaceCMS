<meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="file-upload-container">

    <form id="fileupload" action="{{ route('manage') }}" method="POST" enctype="multipart/form-data"
          data-load_url="{{ route('app.media.upload') }}"
          data-form-data='{"slider_id": "{{ $slider->id }}", "_token": "{!! csrf_token() !!}"}'
          >
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Загрузить файл</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    <span>Начать загрузку</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="fa fa-ban" aria-hidden="true"></i>
                    <span>Отменить загрузку</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    <span>Удалить</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped">
            <tbody class="files">
                @forelse ($media as $item)
                    <tr class="template-download">
                        <td>
                            <span class="preview">
                                @if($item->thumb())
                                    <a href="{{ $item->file_url }}" title="{{ basename($item->file_url) }}" download="{{ basename($item->file_url) }}" data-gallery><img src="{{ $item->thumb()->file_url }}"></a>
                                @endif
                            </span>
                        </td>
                        <td>
                            <p class="name">
                                @if($item->file_url)
                                    <a href="{{ $item->file_url }}" title="{{ basename($item->file_url) }}" download="{{ basename($item->file_url) }}">{{ basename($item->file_url) }}</a>
                                @else
                                    <span>{{ basename($item->file_url) }}</span>
                                @endif
                            </p>
                        </td>
                        <td>

                        </td>
                        <td>
                        <button onclick="if(confirm('Удалить {{ basename($item->file_url) }}?')){ return true }else{ return false }" class="btn btn-danger delete" data-type="POST" data-url="{{ route("admin.media.destroy", $item) }}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            <span>Удалить</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </form>        
</div>
    
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="fa fa-ban" aria-hidden="true"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>

        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button onclick="if(confirm('Удалить {%=file.name%}?')){ return true }else{ return false }" class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    <span>Удалить</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="fa fa-ban" aria-hidden="true"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
