import React from "react";
import { Alert } from "@mui/material";

/**
 * ValidationErrors component.
 *
 * @unreleased
 */
export default function ValidationErrors({ className, errors }) {
  return (
    Object.keys(errors).length > 0 && (
      <div className={className}>
        {Object.keys(errors).map(function (key) {
          return (
            <Alert key={key} severity="error">
              {errors[key]}
            </Alert>
          );
        })}
      </div>
    )
  );
}
