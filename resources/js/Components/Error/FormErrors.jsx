import React from "react";
import { Alert } from "@mui/material";

/**
 * FormErrors component.
 *
 * @since 1.0.0
 */
export default function FormErrors({ className, errors }) {
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
