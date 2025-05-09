@extends('layouts.master')
@section('title', 'Cryptography')
@section('content')
<div class="container">
    <form action="{{route('cryptography')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Encrypt Text</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="text_to_encrypt" class="form-label">Text to Encrypt:</label>
                            <textarea class="form-control" id="text_to_encrypt" name="text_to_encrypt" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" name="action" value="encrypt" class="btn btn-primary">Encrypt</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Decrypt Text</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="text_to_decrypt" class="form-label">Text to Decrypt:</label>
                            <textarea class="form-control" id="text_to_decrypt" name="text_to_decrypt" rows="3"></textarea>
                        </div>
                       
                        <button type="submit" name="action" value="decrypt" class="btn btn-primary">Decrypt</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Hash Text</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="text_to_hash" class="form-label">Text to Hash:</label>
                            <textarea class="form-control" id="text_to_hash" name="text_to_hash" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="hash_algorithm" class="form-label">Hash Algorithm:</label>
                            <select class="form-select" id="hash_algorithm" name="hash_algorithm">
                                <option value="md5">MD5</option>
                                <option value="sha1">SHA1</option>
                                <option value="sha256">SHA256</option>
                                <option value="sha512">SHA512</option>
                            </select>
                        </div>
                        <button type="submit" name="action" value="hash" class="btn btn-primary">Hash</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(isset($result))
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Result</h5>
                </div>
                <div class="card-body">
                    <pre class="mb-0">{{ $result }}</pre>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection