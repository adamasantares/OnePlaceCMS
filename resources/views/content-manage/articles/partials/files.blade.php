<meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="file-upload-container">

    <form id="filesupload" action="{{ route('content-manage') }}" method="POST" enctype="multipart/form-data"
          data-load_url="{{ route('app.content-file.upload') }}"
          data-form-data='{"content_id": "{{ $article->id }}", "_token": "{!! csrf_token() !!}"}'
          data-upload-template-id="template-upload-files"
          data-download-template-id="template-download-files"
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
        @php
            function getLinkToIconForExt($path) {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $img = '/images/ext-icons/';

                switch ($ext) {
                    case 'pdf':
                        $img .= 'pdf.png';
                        break;
                    case 'csv':
                        $img .= 'xls.png';
                        break;
                    case 'xls':
                        $img .= 'xls.png';
                        break;
                    case 'xlsx':
                        $img .= 'xls.png';
                        break;
                    case 'doc':
                        $img .= 'doc.png';
                        break;
                    case 'docx':
                        $img .= 'doc.png';
                        break;
                    case 'txt':
                        $img .= 'txt.png';
                        break;
                }
                return $img;
            }
        @endphp
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped">
            <tbody class="files">
                @forelse ($files as $item)
                    <tr class="template-download">
                        <td>
                            <span class="preview">
                                <a href="{{ $item->file_url }}" title="{{ basename($item->file_url) }}" download="{{ basename($item->file_url) }}"><img width="64" src="{{ getLinkToIconForExt($item->file_url) }}"></a>
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
                        <button onclick="if(confirm('Удалить {{ basename($item->file_url) }}?')){ return true }else{ return false }" class="btn btn-danger delete" data-type="POST" data-url="{{ route("admin.content-file.destroy", $item) }}">
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

