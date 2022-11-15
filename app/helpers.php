<?php
function json_res(bool $state, string $msg = "", array $data = [], int $status = null): array

{
    return ["state" => $state, "msg" => $msg, "data" => $data, "status" => $status];
}
